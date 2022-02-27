@extends('layouts.app')

@section('styles')
<style>
    .product-picture {
        width: 100px;        
        display: block;
    }
    .mt-cont{
        margin-top: 5rem !important;
    }
</style>
@endsection

@section('content')


<div class="container mt-cont">
    <div class="mb-4">
        @if ($errors->isNotEmpty())
                <div class="alert alert-warning" role="alert">
                    @foreach ($errors->all() as $error)
                        {{$error}}
                        @if (!$loop->last)<br> @endif
                    @endforeach
                </div>
            @endif
            
            @if (session('updateProductSuccess'))
            <div class="alert alert-success" role="alert">
            Продукт успешно обновлен!     
            </div>
            @endif 
            @if (session('needProductError'))
            <div class="alert alert-success" role="alert">
            Продукт не найден!     
            </div>
            @endif 
            
            @if (session('deleteProductSuccess'))
            <div class="alert alert-success" role="alert">
            Продукт удален!     
            </div>
            @endif 
            <div class="row">
        <div class="col-sm-8">
            <div class="card" >   
            <div class="card-body">
                <h3 class="card-title">Изменить продукт</h3>
            <form method="post" action="{{route('updateProduct')}}" class="mb-4" enctype="multipart/form-data">
            <input type="hidden" value="{{ $product->id }}" name='product_id'> 
            <input type="hidden" value="{{ $product->category_id }}" name='category_id'> 
            
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Изображение</label>
                    <image class="product-picture mb-2" src="{{asset('storage')}}/{{$product->picture}}">
                    <input type="file" name="picture" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Наименование</label>
                    <input class="form-control mb-2" value="{{ $product->name }}" name='name'>
                </div>
                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <input class="form-control mb-2" value="{{ $product->description }}" name='description'>
                </div>
                <div class="mb-3">
                    <label class="form-label">Цена</label>
                    <input class="form-control mb-2" name='price' value="{{ $product->price }}" type="number" min="1" step="any">        
                </div>                    
                <button class="btn btn-success" type="submit">Сохранить</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>    
  </div>