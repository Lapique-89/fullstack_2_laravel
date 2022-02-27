@extends('layouts.app')

@section('styles')
<style>
    .product-price {
        border-bottom: 1px solid grey;
        font-size: 23px;
        text-align: center;
        margin-bottom: 10px;
    }
    .card-text {
        height: 46px;
    }
    .product-buttons {
        display: flex;
        justify-content: space-between;
        line-height: 37px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <category-products-component category="{{$category}}"></category-products-component>
</div>
@endsection