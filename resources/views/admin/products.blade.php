
@extends ('layouts.app')
@section ('title')
    Список продуктов
@endsection
@section('styles')
<style>
 .table{
	border: 1px solid #eee;	
	width: 100%;
	margin-bottom: 0px;
}
.table th {
	font-weight: bold;
	padding: 10px;
	background: #efefef;
	border: 1px solid #dddddd;
}
.table td{
	padding: 8px 10px;
	border: 1px solid #eee;
	text-align: left;
}
.pict {
	padding: 5px 10px!important;
	border: 1px solid #eee;
	text-align: left;
}
/* .table tbody tr:nth-child(odd){
	background: #fff;
}
.table tbody tr:nth-child(even){
	background: #F7F7F7;
} */
.scroll-table-body {
	height: 320px;
	overflow-x: auto;
	margin-top: 0px;
	margin-bottom: 20px;
	border-bottom: 1px solid #ddd;
}
.scroll-table table {
	width:100%;
	table-layout: fixed;
	border: none;
}
.scroll-table thead th {
	font-weight: bold;
	text-align: left;
	border: none;
	padding: 10px;
	/* background: #d8d8d8; */
	font-size: 14px;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
}
.scroll-table tbody td {
	text-align: left;
	border-left: 1px solid #ddd;
	border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
	padding: 8px 10px;
	font-size: 14px;
	vertical-align: top;
}
/* .scroll-table tbody tr:nth-child(even){
	background: #f3f3f3;
} */
 
/* Стили для скролла */
::-webkit-scrollbar {
	width: 6px;
} 
::-webkit-scrollbar-track {
	box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
	box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
.product-picture {
        width: 89px;
        margin-bottom: 0px;
        margin-right: 0px;
        display: block;
    }
    .btn-a {
    padding-top: 1.375rem;
    padding-bottom: 0px;
    padding-left: 0px;
    padding-right: 0px;

    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-10 col-md-8">
            <h1>
                {{ $title }}
            </h1>
        </div>
        <div class="col-2 ">
            <form method="post" action="{{ route('exportProducts')}}" >
                @csrf
                <button type="submit" class="btn btn-link pb-0 btn-a" >Выгрузить продукты</button>
            </form>    
        </div>
        <div class="col-2 ">
            <form method="post" action="{{ route('importProducts')}}" class="mb-0 ms-auto">
                @csrf
                <button type="submit" class="btn btn-link pb-0 btn-a align-self-end" >Загрузить продукты</button>
            </form>
        </div>
    </div>
    <div class="scroll-table">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th width="40">#</th>
                <th width="110">Изображение</th>
                <th width="20%">Категория</th>
                <th width="20%">Наименование</th>
                <th width="40%">Описание</th>                
                <th width="10%">Цена</th>
                
            </tr>
        </thead>
        </table>
        <div class="scroll-table-body">
		<table>
        <tbody>
        @foreach ($products as $product)
                <tr>
                    <td width="40">{{$product->id_into_table}}</td>
                    <td  width="110"class="pict"><image class="product-picture mb-0" src="{{asset('storage')}}/{{$product->picture}}"></td>
                    <td width="20%"> {{$product->category}} </td>
                    <td width="20%">{{ $product->name }}</td>
                    <td width="40%">{{ $product->description }}</td>
                    <td width="10%">{{ $product->price }}</td>
                    
                </tr>
            @endforeach
            </tbody>
		</table>
	</div>	
</div>

    @if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
                @if (!$loop->last)<br> @endif
            @endforeach
        </div>
    @endif

    @if (session('startExportProducts'))
    <div class="alert alert-success">
        Выгрузка продуктов запущена
    </div>
    @endif
    @if (session('startImportProducts'))
        <div class="alert alert-success">
            Загрузка продуктов запущена
        </div>
    @endif
    @if (session('productCreate'))
    <div class="alert alert-success" role="alert">
       Категория успешно добавлена!     
    </div>
    @endif 
    

    <form method="post" action="{{route('addProduct')}}" class="mb-4" enctype="multipart/form-data">
        <h3>Добавить новый продукт</h3>
        @csrf
        <div class="mb-3">
            <select class="form-control mb-2" name='category_id'>
                <option disabled selected>-- Выберите категорию --</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Изображение</label>
            <image class="user-picture mb-2" src="">
            <input type="file" name="picture" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Наименование</label>
            <input class="form-control mb-2" name='name'>
        </div>
        <div class="mb-3">
            <label class="form-label">Описание</label>
            <input class="form-control mb-2" name='description'>
        </div>
        <div class="mb-3">
            <label class="form-label">Цена</label>
            <input class="form-control mb-2" name='price' type="number" min="1" step="any">        
        </div>                    
        <button class="btn btn-success" type="submit">Сохранить</button>
</form>
    
@endsection