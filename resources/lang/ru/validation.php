<?php
return [
'accepted' => 'Необходимо принять :attribute.',
    'active_url' => ':attribute не верный URL.',
    'after' => 'Дата :attribute должна быть после :date.',
    'after_or_equal' => 'Дата :attribute должна быть после или равна :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должно быть массив.',
    'before' => 'Дата :attribute должна быть раньше :date.',
    'before_or_equal' => 'Дата :attribute должна быть раньше и или равной :date.',
    'between' => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file' => ':attribute должно быть между :min и :max kB.',
        'string' => ':attribute должно быть между :min и :max символов.',
        'array' => ':attribute characters :min и :max элементов.',
    ],
    'boolean' => ':attribute поле должно быть истинным или ложным.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'date' => 'Дата :attribute имеет неверное значение.',
    'date_equals' => 'Дата :attribute должна быть равной :date.',
    'date_format' => 'Дата :attribute не соотвествует формату :format.',
    'different' => ':attribute и :other должны быть другими.',
    'digits' => ':attribute должна быть цифрой :digits.',
    'digits_between' => 'Цифра :attribute должна быть между :min и :max .',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute поле содержит повторяющиеся значения.',
    'email' => ':attribute должна иметь верный формат.',
    'ends_with' => ':attribute должно заканчиваться одним из следующих пунктов: :values.',
    'exists' => 'Выбранный пункт :attribute недопустим.',
    'file' => ':attribute должен быть файлом.',
    'filled' => 'Поле :attribute  не должно быть пустым.',
    'gt' => [
        'numeric' => ':attribute должно быть больше, чем :value.',
        'file' => ':attribute должно быть больше, чем :value kB.',
        'string' => ':attribute должно быть больше, чем :value символов.',
        'array' => ':attribute должно быть больше, чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должно быть больше или равно :value.',
        'file' => ':attribute должно быть больше или равно :value kB.',
        'string' => ':attribute должно быть больше или равно :value символов.',
        'array' => ':attribute должени иметь значение больше или равно :value элементам.',
    ],
    'image' => ':attribute должно быть изображением.',
    'in' => 'Нодопустимый выбор :attribute.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => ':attribute должно быть числом.',
    'ip' => ':attribute неверный IP адрес.',
    'ipv4' => ':attribute неверный IPv4 адрес.',
    'ipv6' => ':attribute неверный IPv6 адрес.',
    'json' => ':attribute неверный формат JSON.',
    'lt' => [
        'numeric' => ':attribute должно быть меньше чем :value.',
        'file' => ':attribute должно быть меньше чем :value kB.',
        'string' => ':attribute должно быть меньше чем :value символов.',
        'array' => ':attribute должно быть меньше чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должно быть меньше или равно :value.',
        'file' => ':attribute должно быть меньше или равно :value kB.',
        'string' => ':attribute должно быть меньше или равно :value символов.',
        'array' => ':attribute не должно быть больше, чем :value элементов.',
    ],
    'max' => [
        'numeric' => ':attribute не может быть больше чем :max.',
        'file' => ':attribute не может быть больше чем :max kB.',
        'string' => ':attribute не может быть больше чем :max символов.',
        'array' => ':attribute не может быть больше чем :max элементов.',
    ],
    'mimes' => ':attribute файл должен быть типом: :values.',
    'mimetypes' => ':attribute файл должен быть типом: :values.',
    'min' => [


'numeric' => ':attribute должно быть по крайней мере :min.',
        'file' => ':attribute должно быть по крайней мере :min kB.',
        'string' => ':attribute должно быть по крайней мере :min символов.',
        'array' => ':attribute должно быть по крайней мере :min элементов.',
    ],
    'multiple_of' => ':attribute должно быть кратно :value',
    'not_in' => ':attribute не верное значение.',
    'not_regex' => ':attribute неверный формат',
    'numeric' => ':attribute must be a number.',
    'password' => 'Некоректный пароль.',
    'present' => 'Поле :attribute незаполнено.',
    'regex' => ':attribute неверный формат.',
    'required' => ':attribute обязательное поле.',
    'required_if' => ':attribute обязательное поле когда :other имеет значение :value.',
    'required_unless' => ':attribute поле является обязательным когда :other имеет значение :values.',
    'required_with' => ':attribute обязательное поле :values если не пустое.',
    'required_with_all' => ':attribute обязательное поле при наличии значения :values.',
    'required_without' => ':attribute поле обязательно когда значение :values пустое.',
    'required_without_all' => 'Поле :attribute обязательно, если нет ни одного из следующих значений :values.',
    'same' => 'Поле :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть :size kB.',
        'string' => ':attribute должен быть :size символов.',
        'array' => ':attribute должен содержать :size элементов.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих значений: :values.',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть в допустимой зоне.',
    'unique' => ':attribute уже был принят.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => ':attribute неверный формат.',
    'uuid' => ':attribute должен быть валидным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => "Имя",
        'email' => 'Почта'
    ],
];