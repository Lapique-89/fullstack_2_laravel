@extends('layouts.app')


@section('styles')
<style>
    .product-buttons {
        display: flex;
        justify-content: space-evenly;
        line-height: 37px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    @if (Auth::user()->hasOrder()) 
 
        <form method="get" action="{{ route('orders')}}" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-link pb-0 ">Заказы</button>            
        </form>    
    @endif
    </div> 
    </div> 
    <cart-component 
        :prods="{{$products}}"
        :user="{{$user}}"
        address="{{$address}}"
    ></cart-component>
    
@endsection