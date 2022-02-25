@extends('layouts.app')

@section('title')
    Список пользователей
@endsection
@section('styles')
<style>
    .mf {
        margin-left:15px;        
        
    }
    .pict {
	padding: 5px 10px!important;
	border: 1px solid #eee;
	text-align: left;
    }
    .product-picture {
        width: 89px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
    }
    .f_bold {
        font-weight: bold;
        font-style: normal;
        margin-bottom: 0px;
}
    
</style>
@endsection
@section('content')
<h1>
        {{ $title }}
    </h1>

    
            @foreach ($orders as $order)
            <div class="row">
                <div class="col-sm-12">
                    <div class="card" >   
                        <div class="card-body">

                        <form method="post"  action="{{route('RepeatCart')}}"  enctype="multipart/form-data">       
                            @csrf        
                            @foreach ($order->products as $product)
                            
                                <div class="row ">
                                    <div class="col-sm-12">
                                        <div class="card" >   
                                            <div class="card-body ">
                                            <div class="row ">
                                    <div class="col-sm-1">
                                    <image class="product-picture mb-0" src="{{asset('storage')}}/{{$product->picture}}">
                                    </div>
                                    <div class="col-sm-8">    
                                                <div class="row">
                                                    <div class="col-sm-12 f_bold">
                                                        {{$product->name}}                                   
                                                    </div>  
                                                    <div class="col-sm-12">
                                                        {{$product->description}}                                   
                                                    </div>                                      
                                                    <div class="col-sm-12">                                       
                                                        Количество:  {{ $product->pivot->quantity  }}
                                                    </div>
                                                </div> 
                                                </div>        
                                            </div>
                                        </div>
                                    </div>          
                              
                                </div>
                                </div>     
                            @endforeach 

                            <div class="row  ">
                                <div class="col-sm-12 mb-1 mt-2 mf">
                                <p class="mb-0"><em class="f_bold">Номер заказа: </em>{{ $order->id }}</p>
                                </div>   
                                <div class="col-sm-12 mb-1 mf">
                                
                                <p class="mb-0"><em class="f_bold">Дата заказа: </em>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</p> 
                                </div> 
                                <div class="col-sm-12 mb-1 mf">
                                @foreach ($addresses as $address)
                                    @if ($address->id == $order->address_id) 
                                        <p class="mb-0"><em class="f_bold">Адрес заказа: </em>{{ $address->address }}</p>
                                    
                                    @endif
                                @endforeach
                                       
                                    
                                
                                </div>
                            </div> 
                            <input name='id' hidden value="{{ $order->id }}">
                            <button class="btn btn-success mf" type="submit">Добавить в корзину</button>
                        </form>
                   
                        </div>
                    </div>
                </div>    
            </div>    
            @endforeach
   
@endsection