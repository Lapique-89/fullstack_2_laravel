Уважаемый, {{$data['name']}}!
Благодарим Вас за заказ.

<table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            @php
                $summ = 0;    
            @endphp
            @foreach ($data['products'] as $idx => $product)
                @php
                    $productSumm = $product->price * $product->pivot->quantity;
                    $summ += $productSumm;
                @endphp
                <tr>
                    <td>{{$idx + 1}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td >                       
                        {{ $product->pivot->quantity }}                       
                    </td>
                    <td>
                        {{ $productSumm }}
                    </td>
                </tr>
            
            @endforeach
                <tr>
                    <td colspan="4" class="text-end">Итого:</td>
                    <td>
                        <strong>  
                        {{ $summ }}
                        </strong>
                    </td>
                </tr>
        </tbody>
    </table>

    Будем рады видеть Вас снова.