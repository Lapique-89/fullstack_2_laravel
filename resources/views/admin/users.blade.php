@extends('layouts.app')

@section('title')
    Список пользователей
@endsection

@section('content')

    @if ($errors->isNotEmpty())
        <div class="alert alert-warning" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
                @if (!$loop->last)<br> @endif
            @endforeach
        </div>
    @endif

    <h1>Список ролей</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $idx => $role)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{$role->name}}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="2">Ролей пока нет</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <form method="post" action="{{route('addRole')}}" class="mb-4">
        <h3>Добавить новую роль</h3>
        @csrf
        <input class="form-control mb-2" name='name'>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>

    <form method="post" action="{{route('addRoleToUser')}}" class="mb-4">
        <h3>Добавить роль пользователю</h3>
        @csrf
        <select class="form-control mb-2" name='user_id'>
            <option disabled selected>-- Выберите пользователя --</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <select class="form-control mb-2" name='role_id'>
            <option disabled selected>-- Выберите роль --</option>
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>

    <h1>
        {{ $title }}
    </h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Почта</th>
                <th>Роли</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <ul>
                            @foreach ($user->roles as $role)
                                <li>{{$role->name}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('enterAsUser', $user->id) }}">Войти</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   
@endsection