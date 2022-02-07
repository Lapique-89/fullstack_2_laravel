@extends ('layouts.app')

@section ('title')
    Список пользователей
@endsection

@section('content')

    <h1>
        {{ $title }}
    </h1>
    <table class="table table-bordered mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Админ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin }}</td>
            <td class="text-center">
                <a href="{{ route('enterAsUser', $user->id) }}">Войти</a>
            </td>
        </tr>
        @endforeach
        
    </tbody>
    </table>
    @if (session('startExportCategories'))
    <div class="alert alert-success ">
        Выгрузка категорий запущена
    </div>
@endif
    <form method="post" action="{{ route('exportCategories') }}">
                            @csrf
                            
                            <button class="btn btn-link">Выгрузить категории</button>
                        </form>
                        <form method="post" action="{{ route('importCategories') }}">
                            @csrf
                            
                            <button class="btn btn-link">Загрузить категории</button>
                        </form>
@endsection
