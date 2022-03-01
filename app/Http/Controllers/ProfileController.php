<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile (User $user)
    {
        if (!Auth::user()) 
            return redirect()->route('home');
        if (Auth::user()->isAdmin() || $user->id == Auth::user()->id) 
        {
            $addresses = $user->addresses()->get();
            
            return view('profile', compact('user', 'addresses'));
        }
          //  return view('profile', compact('user'));

        return redirect()->route('home');  
    }
    public function getAddress (User $user)
    {

         $address = $user->addresses()->get();
        return $address;  
    }
    public function save (Request $request)
    {
        //$name = request('name');//достать один параметр
       $input = request()->all(); 
        $name = $input['name'];
       $email = $input['email'];
       $picture = $input['file'] ?? null;
       $newAddress = $input['new_address'];
       $userId = $input['userId'];
       $isMain = $input['is_Main'] ?? null;

  $user = User::find($userId);

        request()->validate([
            'name' => 'required', //поле обязательное            
            'email' => "email|required|unique:users,email,{$user->id}",
            'picture' => 'mimetypes:images/*',
            'current_password' => 'current_password|required_with:password|nullable',
            'password' => 'confirmed|min:6|nullable'
        ]);

        if ($input['password']) {
            $user->password = Hash::make($input['password']);
            $user->save();
        }
        Address::where('user_id', $user->id)->update([
            'main' => 0
        ]);
        Address::where('id', $input['main_address'])->update([
            'main' => 1
        ]);

        if ($newAddress) {
            if ($isMain) {
            Address::where('user_id', $user->id)->update([
                'main' => 0
            ]);

            Address::create([
                'user_id' => $user ->id,
                'address' => $newAddress,
                'main' => 1
            ]);
            }
            else {
                Address::create([
                    'user_id' => $user ->id,
                    'address' => $newAddress,
                    'main' => 0
                ]); 
            }
        }
        if ($picture) {
            
            $ext = $picture->getClientOriginalExtension();//получаем расширение 
            $filename = time() . rand(10000,99999) . '.' . $ext;
            $picture->storeAs('public/users', $filename); //сохраняем файл в папке проекта
            $user->picture = "users/$filename";
        }
       $user->name = $name;
       $user->email = $email;
       $user->save();

       session()->flash('profileSaved');//показывает ключ один раз и удаляется 
       $addresses = $user->addresses()->get();
       $result = [
        'user' => $user,
        'addresses' => $addresses,
        
    ];
       return $result;
    }
}
