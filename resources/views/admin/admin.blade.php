@extends ('layouts.app')

@section ('title')
    Админка
@endsection

@section('content')
<!-- <div class="d-grid gap-2 col-12 mx-auto">
    <a href="{{ route('adminUsers') }}">Пользователи</a>
    <a href="{{ route('adminProducts') }}">Продукты</a>
    <a href="{{ route('adminCategories') }}">Категории</a>
</div> -->
<div class="row">
  <div class="col-sm-3">
    <div class="card" >
   <!-- <img src="..." class="card-img-top" alt="..."> --> 
      <div class="card-body">
        <h5 class="card-title">Пользователи</h5>
        <p class="card-text">Список пользователей, ролей</p>
        <a  class="btn btn-primary" href="{{ route('adminUsers') }}">Перейти</a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
    <!-- <img src="..." class="card-img-top" alt="..."> -->
      <div class="card-body">
        <h5 class="card-title">Продукты</h5>
        <p class="card-text">Данные продуктов</p>
        <a  class="btn btn-primary" href="{{ route('adminProducts') }}">Перейти</a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
   <!--  <img src="..." class="card-img-top" alt="..."> -->
      <div class="card-body">
        <h5 class="card-title">Категории</h5>
        <p class="card-text">Данные категорий</p>
        <a class="btn btn-primary" href="{{ route('adminCategories') }}">Перейти</a>
      </div>
    </div>
  </div>
</div>
@endsection