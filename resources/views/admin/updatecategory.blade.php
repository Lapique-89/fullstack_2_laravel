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
<div class="container">
@if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
                @if (!$loop->last)<br> @endif
            @endforeach
        </div>
    @endif
    
    @if (session('updateCategorySuccess'))
    <div class="alert alert-success" role="alert">
       Категория успешно обновлена!     
    </div>
    @endif 
    @if (session('needCategoryError'))
    <div class="alert alert-success" role="alert">
       Категория не найдена!     
    </div>
    @endif 
<div class="row">
  <div class="col-sm-8">
    <div class="card" >   
      <div class="card-body">
        <h3 class="card-title">Изменить категорию</h3>
        <form method="post" action="{{route('updateCategory')}}" class="mb-4" enctype="multipart/form-data">       
        @csrf
        <input type="hidden" value="{{ $category->id }}" name='category_id'>        
            <div class="mb-3">
                <label class="form-label">Изображение</label>
                <image class="category-picture mb-2" src="{{asset('storage')}}/{{$category->picture}}">
                <input type="file" name="picture" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Наименование</label>
                <input class="form-control mb-2" value="{{ $category->name }}" name='name'>
            </div>
            <div class="mb-3">
                <label class="form-label">Описание</label>
                <input class="form-control mb-2" value="{{ $category->description }}" name='description'>
            </div>
                            
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
@endsection