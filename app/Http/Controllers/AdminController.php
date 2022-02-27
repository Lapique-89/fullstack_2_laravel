<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Jobs\ExportCategories;
use App\Jobs\ExportProducts;
use App\Jobs\ImportCategories;
use App\Jobs\ImportProducts;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   public function admin ()
   {
      return view('admin.admin'); 
   }
    public function users ()
    {
       $users = User::get();
     //  dd($users);//останавливает код и отображает коллекцию
      $roles = Role::get();
      $data = [
          'title' => 'Список пользователей',
          'users' => $users,
          'roles' => $roles,
          
       ];
       return view('admin.users', $data); 
    }

    //вывод списка продуктов
    public function products ()
    {
      $products = DB::table('products as p')
      ->select(
         'p.id','p.name', 'p.description', 'p.price', 'p.category_id', 'c.name as category' ,'p.picture'       
     )
      ->join('categories as c', 'p.category_id', '=', 'c.id')
      ->orderBy('c.id')      
      ->get();
      
      $i=1;
      foreach ($products as $product)
      {
         $product->id_into_table=$i;
         $i++;
      }
      $categories = Category::get();
      
      $data = [
         'title' => 'Продукты',
         'title1' => 'Список продуктов',
         'products' => $products,
         'categories' => $categories,         
      ];
      return view('admin.products', $data);        
    }

    //вывод списка категорий
    public function categories ()
    {
      $categories = Category::get();
      $i=1;
      foreach ($categories as $category)
      {
         $category['id_into_table']=$i;
         $i++;
      }
       return view('admin.categories', compact('categories'));  
    }

    public function enterAsUser ($id)
    {
       Auth::loginUsingId($id);
       return redirect()->route('adminUsers'); 
    }

    public function exportCategories ()
    {
       ExportCategories::dispatch(); 
       session()->flash('startExportCategories');
       return back();
    }
    public function importCategories (Request $request)
    {
      $request->validate([         
         'fileImport' => 'required|file|mimes:csv,txt', 
      ]);     

      $file=$request->file('fileImport');
      $filename = $file->getClientOriginalName();    
      $fileall=$file->storeAs('public/categories', $filename); 
      $tpm_file = $_SERVER['DOCUMENT_ROOT'] . '\\storage\categories\\'.$filename;
      $this->dispatch(new ImportCategories($tpm_file));  
      session()->flash('startImportCategories');
      return back();
    }
    public function exportProducts()
    {
       ExportProducts::dispatch();  
       session()->flash('startExportProducts');
       return back(); 
    }
    public function importProducts (Request $request)
    {
      $request->validate([         
         'fileImport' => 'required|file|mimes:csv,txt', 
      ]);
      $file=$request->file('fileImport');
      $filename = $file->getClientOriginalName();    
    $fileall=$file->storeAs('public/products', $filename); 
      $tpm_file = $_SERVER['DOCUMENT_ROOT'] . '\\storage\products\\'.$filename;
      $this->dispatch(new ImportProducts($tpm_file));  
       session()->flash('startImportProducts');
       return back();
    }
    public function getcategory ($id)
    {
      $category = Category::find($id);
      return view('admin.updatecategory', compact('category'));
    } 
    public function addCategory ()
    {
      request()->validate([
         'name' => 'required|min:3',
         'description' => 'required|min:3',    
         'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
   
       //  'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',         
     ]);
  
     $picture = request('picture') ?? null;
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
        ]);
        session()->flash('categoryCreated');//показывает ключ один раз и удаляется
        return back();
    }
    public function updateCategory (Request $request)
    {
        $input = request()->all();
        $name = $input['name'];
        $description = $input['description'];
        $picture = $input['picture'] ?? null;
        $categoryId = $input['category_id'] ?? null;

        if (!$categoryId) {
            session()->flash('needCategoryError');
            return back(); 
        }

        $category = Category::find($categoryId);
       // dump($category);
       
        request()->validate([
         'name' => 'required|min:3',
         'description' => 'required|min:3', 
         'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',

        ]);
        if ($picture) {
            $mimeType = request()->file('picture')->getMimeType();
            $type = explode('/', $mimeType);

            if ($type[0] == 'image') {
                $ext = $picture->getClientOriginalExtension();
                $fileName = time() . rand(10000, 99999). "." . $ext;
                $picture->storeAs('public/categories', $fileName);
                $category->picture = "categories/$fileName";
            } 
        } 
        
        if ($name) $category->name = $name;
        if ($description) $category->description = $description;
        $category->save(); //Вызываем метод save, чтобы сохранить изменения в базе.
        session()->flash('updateCategorySuccess');
        return redirect()->route('adminCategories');
     }

    public function deleteCategory ($id)
    {
        Category::where('id', $id)->delete();
        return back();
    }
    public function addProduct ()
    {
      $input = request()->all(); 
      $name = $input['name'];
      
      $description = $input['description'];
      $price = $input['price'];
      $picture = $input['picture'] ?? null;
      $category_id = $input['category_id'];
      
        request()->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required',
            'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'category_id' => 'required'
        ]);
     

        if ($picture) {            
            $ext = $picture->getClientOriginalExtension();//получаем расширение 
            $filename = time() . rand(10000,99999) . '.' . $ext;
            $picture->storeAs('public/products', $filename); //сохраняем файл в папке проекта
            $picturebase = "products/$filename";
         }
    
        Product::create([
            'name' => $name,
            'description' => $description,
            'picture' => $picturebase,
            'price' => $price,
            'category_id' => $category_id,
        ]);
        session()->flash('productCreate');//показывает ключ один раз и удаляется
        return back();
      }
      public function getProduct ($id)
      {
        $product = Product::find($id);
        return view('admin.updateproduct', compact('product'));
      } 
      public function updateProduct ()
      {
          $input = request()->all();
          $name = $input['name'];
          $description = $input['description'];
          $price = $input['price'];
          $picture = $input['picture'] ?? null;
          $productId = $input['product_id'] ?? null;
  
          if (!$productId) {
              session()->flash('needProductError');
              return back(); 
          }
  
          $product = Product::find($productId);
          request()->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required',
            'picture' => 'nullable|mimetypes:image/*',
            'category_id' => 'required'
        ]);
         
          if ($picture) {
              $mimeType = request()->file('picture')->getMimeType();
              $type = explode('/', $mimeType);
  
              if ($type[0] == 'image') {
                  $ext = $picture->getClientOriginalExtension();
                  $fileName = time() . rand(10000, 99999). "." . $ext;
                  $picture->storeAs('public/products', $fileName);
                  $product->picture = "products/$fileName";
              } 
          } 
          
          if ($name) $product->name = $name;
          if ($description) $product->description = $description;
          if ($price) $product->price = $price;
          $product->save(); //Вызываем метод save, чтобы сохранить изменения в базе.
          session()->flash('updateProductSuccess');
          return redirect()->route('adminProducts');
      }
      public function deleteProduct ($id)
      {
          Product::where('id', $id)->delete();
          session()->flash('deleteProductSuccess');
          return back();
      }
  
    public function addRole ()
    {
        request()->validate([
            'name' => 'required|min:3',
        ]);

        Role::create([
            'name' => request('name')
        ]);
        return back();
    }
    public function addRoleToUser ()
    {
        request()->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::find(request('user_id'));
        $user->roles()->attach(Role::find(request('role_id')));
        return back();
    }
}