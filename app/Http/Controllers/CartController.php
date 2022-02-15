<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function cart () {
        $cart = session('cart') ?? [];

        $products = Product::whereIn('id', array_keys($cart))
                        ->get()
                        ->transform(function ($product) use ($cart) {
                            $product->quantity = $cart[$product->id];
                            return $product;
                        });  
        $user= Auth::user();

        $address = $user ? $user->addresses()->where('main', 1)->first()->address ?? '' : '';
        return view('cart', compact('products', 'user', 'address'));
    }

    public function removeFromCart () {
        $productId = request('id'); 
        $cart = session('cart') ?? [];

        if (!isset($cart[$productId]))
            return back();
        
        $quantity = $cart[$productId];
        if ($quantity > 1) {
            $cart[$productId] = --$quantity;
        } else {
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);
        return back();
    }

    public function addToCart ()
    {
        $productId = request('id');
        $cart = session('cart') ?? [];

        if (isset($cart[$productId])) {
            $cart[$productId] = ++$cart[$productId];
        } else {
            $cart[$productId] = 1;
        }

        session()->put('cart', $cart);
        return back();
    }
    public function createOrder ()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'register_confirmation' => 'accepted'
        ]);
        DB::transaction(function () {
            $user = Auth::user();
            if (!$user) {
                $password = \Illuminate\Support\Str::random(8);
                $user = User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => Hash::make($password)
                ]);
    
                $address = Address::create([
                    'user_id' => $user->id,
                    'address' => request('address'),
                    'main' => 1
                ]);

                Auth::loginUsingId($user->id);
            }
    
            $address = $user->getMainAddress();
    
            $cart = session('cart');
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address->id
            ]);
    
            foreach ($cart as $id => $quantity) {
                $product = Product::find($id);
                $order->products()->attach($product, [
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);
            }
    
            $data = [
                'products' => $order->products,
                'name' => $user->name,
                'password' => $password
            ];
            Mail::to($user->email)->send(new OrderCreated($data));
        });        

        session()->forget('cart');
        return back();
        
    }
}