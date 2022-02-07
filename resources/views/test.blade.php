{{ date ('d.m.Y H:i:s') }}
<h1>
    {{ $title}}
</h1>

@if ($number > 5)
Ваше число больше 5
@else
    меньше
@endif



<ul>
@foreach ($numbers as $number) 
   
    <li>
        {{ $number }}
        @if ( $loop->first)
            (это первая запись)
        @endif
        @if ( $loop->last)
            (это последняя запись)
        @endif
    </li>
@endforeach
</ul>

@empty ($cities)
   Список городов пустой
@endempty
<br>
@isset ($number)
     Переменная number не определена
@endisset
<br>
@auth
    Вы авторизованы
@endauth

@guest
    Вы гость
@endguest