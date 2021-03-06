<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('orderTest', function () {
    $order = Order::first();  
    $order->products->each(function ($product) {
        dd($product->pivot->quantity);
    });
    
});
/*Artisan::command('importCategoriesFromFile', function () {
    
    $file = fopen('categories.csv', 'r');

    $i = 0;
    $insert = [];
    while ($row = fgetcsv($file, 1000, ';')) {
        if ($i++ == 0) {
            $bom = pack('H*','EFBBBF');
            $row = preg_replace("/^$bom/", '', $row);
            $columns = $row;
            continue;
        }

        $data = array_combine($columns, $row);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $insert[] = $data;        
    }

    Category::insert($insert);
});*/
Artisan::command('queryBuilder', function () {
$data = DB::table('categories as c')
        ->select(
            'c.name',
            'c.description'
        )
        ->where('name', 'Процессоры')
      //  ->get();//получаем массив
      ->first();

      $data =  DB::table('categories as c')
      ->select(
          'c.name',
          DB::raw('count(p.id) as product_quantity'),
          DB::raw('sum(p.price) as priceAmount')
      )
            ->leftJoin('products as p', function ($join){
                $join->on('c.id', 'p.category_id');
  //              ->where('') если join по нескольким полям
            })
            ->groupBy('c.id')
            ->get();

//dd($data);
        DB::table('categories')
        ->orderBy('id')
        ->chunk(4, function ($categories) {
            dump($categories->count());
        });
});
Artisan::command('parseEkatalog', function () {

    $url = 'https://www.e-katalog.ru/ek-list.php?katalog_=189&search_=rtx+3090';

    $data = file_get_contents($url);

    $dom = new DomDocument();
    @$dom->loadHTML($data);

    $xpath = new DomXPath($dom);
    $totalProductsString = $xpath->query("//span[@class='t-g-q']")[0]->nodeValue ?? false;
    
    preg_match_all('/\d+/', $totalProductsString, $matches);
    $totalProducts = (int) $matches[0][0];

    $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']");

    $productsOnOnePage = $divs->length;

    $pages = ceil($totalProducts / $productsOnOnePage);

    $products = [];
    foreach ($divs as $div) {
        $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
        $name = $a[0]->nodeValue;

        $price = 'Нет в наличии';
        $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div);

        if ($ranges->length == 1) {
            foreach ($ranges[0]->childNodes as $child) {
                if ($child->nodeName == 'a') {
                    $price = 'от ' . $child->nodeValue;
                }
            }
        }

        $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
        if ($ranges->length == 1) {
            $price = $ranges[0]->nodeValue;
        }
        $products[] = [
            'name' => $name,
            'price' => $price
        ];
    }

    for ($i = 1; $i < $pages; $i++) {
        $nextUrl = "$url&page_=$i";

        $data = file_get_contents($nextUrl);

        $dom = new DomDocument();
        @$dom->loadHTML($data);
    
        $xpath = new DomXPath($dom);
        $divs = $xpath->query("//div[@class='model-short-div list-item--goods   ']");

        foreach ($divs as $div) {
            $a = $xpath->query("descendant::a[@class='model-short-title no-u']", $div);
            $name = $a[0]->nodeValue;
    
            $price = 'Нет в наличии';
            $ranges = $xpath->query("descendant::div[@class='model-price-range']", $div);
    
            if ($ranges->length == 1) {
                foreach ($ranges[0]->childNodes as $child) {
                    if ($child->nodeName == 'a') {
                        $price = 'от ' . $child->nodeValue;
                    }
                }
            }
    
            $ranges = $xpath->query("descendant::div[@class='pr31 ib']", $div);
            if ($ranges->length == 1) {
                $price = $ranges[0]->nodeValue;
            }
            $products[] = [
                'name' => $name,
                'price' => $price
            ];
        }
    }

    $file = fopen('videocards.csv', 'w');
    foreach ($products as $product) {
        fputcsv($file, $product, ';');
    }
    fclose($file);
});


Artisan::command('massCategoriesInsert', function () {

    $categories = [
        [
            'name' => 'Видеокарты',
            'description' => 'sadfasfsdf',
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            'name' => 'Процессоры',
            'description' => '23в23в32в32в3232',
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ];

    Category::insert($categories);
});

Artisan::command('updateCategory', function () {
  /*  Category::where('id', 2)->update([
        'name' => 'Процессоры'
    ]);*/
    Auth::loginUsingId(1);//получение логина с id 1
    $category = Category::where('name','Процессоры')->first();
    $category->description = 'Intel лучше!';
    $category -> save();
});

Artisan::command('deleteCategory', function () {
    Auth::loginUsingId(1);//получение логина с id 1
     $category = Category::find(21)->delete();
    // $category->delete();
    //Category::whereNotNull('id')->delete();//УДАЛЕНИЕ всех 
});

Artisan::command('createCategory', function () {
   Auth::loginUsingId(1);//получение логина с id 1
    $category = new Category();
    $category->name = 'Видеокарты';
    $category->description = 'Описание видеокарт';
    $category->picture = '2.jpg';
    $category->save();
 

   
});
 
Artisan::command('inspire', function () {

    $user = User::find(2);
    $addresses = $user->addresses->filter(function ($address) {
        return $address->main;
    })->pluck('address');

    $addresses = $user->addresses()->where('main', 1)->get();
    dd($addresses);

    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');