<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::get();
        return view('home', compact('categories'));
    }

    public function category (Category $category)
    {
        $products = $category->products;
        return view('category', compact('products'));
    }
    public function repeatOrder ()
    {
     
  
    /*  $picture = request('picture') ?? null;
     if ($picture) {            
         $ext = $picture->getClientOriginalExtension();//получаем расширение 
         $filename = time() . rand(10000,99999) . '.' . $ext;
         $picture->storeAs('public/products', $filename); //сохраняем файл в папке проекта
         $picturebase = "products/$filename";
      }

        Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'picture' => $picturebase,
        ]); */
        
    }
}
