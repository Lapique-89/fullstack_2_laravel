@extends('layouts.app')
@section('styles')
<style>
    .category-picture {
        width: 100px;
        
        display: block;
    }
    
</style>
@endsection
@section('content')
@auth
<div class="row">
    <div class="col-9">  
      
        Вы вошли!
      
    </div>
    <!-- @if (Auth::user()->hasOrder())
    <div class="col-3">
        <form method="post" action="{{ route('RepeatCart')}}" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-link pb-0 ">Повторить предыдущий заказ</button>
            
        </form> 
    </div> 
    @endif -->
</div>
@endauth



<!-- <div class="container"> -->
    <categories-component 
        :categories="{{$categories}}" 
        page-title="Список категорий" 
        route-category="{{route('category', '')}}"
        test="test"
    ></categories-component>
    <!-- <div class="row">
        @foreach ($categories as $category)
        <div class="col-3">
            <div class="card mb-4" style="width: 18rem;">
            <div class="row">
                <img src="{{ asset('storage') }}/{{$category->picture}}" class="card-img-top " alt="{{$category->name}}">
            </div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{$category->name}}
                    </h5>
                    <p class="card-text">
                        {{ $category->description }}
                    </p>
                    <a href="{{ route('category', $category->id) }}" class="btn btn-primary">Перейти</a>
                </div>
            </div> 
        </div>

        @endforeach
    </div>-->
<!-- </div> -->
@endsection