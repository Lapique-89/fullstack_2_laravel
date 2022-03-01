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
@auth     
    @if (Auth::user()->hasOrder()) 
 
        <form method="get" action="{{ route('orders')}}" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-link pb-0 ">Заказы</button>            
        </form>    
    @endif
    @endauth 

    
    <cart-component
        :prods="{{$products}}"
        @if ($user)
        :user="{{$user}}"
        @endif
        address="{{$address}}"
    >
    </cart-component>

    
@endsection