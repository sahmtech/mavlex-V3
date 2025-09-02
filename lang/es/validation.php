<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Líneas de validación
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de lenguaje contienen los mensajes de error predeterminados utilizados por
    | la clase de validación. Algunas de estas reglas tienen múltiples versiones, tales
    | como las reglas de tamaño. Siéntase libre de ajustar cada uno de estos mensajes aquí.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser un arreglo.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file' => 'El archivo :attribute debe tener entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El campo :attribute no coincide con el formato :format.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes valores: :values',
    'exists' => 'El campo :attribute seleccionado no es válido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'file' => 'El archivo :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El campo :attribute debe ser mayor que :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file' => 'El archivo :attribute debe ser mayor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe ser mayor o igual a :value caracteres.',
        'array' => 'El campo :attribute debe tener :value elementos o más.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El campo :attribute seleccionado no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El campo :attribute debe ser menor que :value.',
        'file' => 'El archivo :attribute debe ser menor que :value kilobytes.',
        'string' => 'El campo :attribute debe ser menor que :value caracteres.',
        'array' => 'El campo :attribute debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El campo :attribute debe ser menor o igual a :value.',
        'file' => 'El archivo :attribute debe ser menor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe ser menor o igual a :value caracteres.',
        'array' => 'El campo :attribute no debe tener más de :value elementos.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file' => 'El archivo :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El campo :attribute no debe ser mayor a :max caracteres.',
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El archivo :attribute debe tener al menos :min kilobytes.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
    ],
    'not_in' => 'El campo :attribute seleccionado no es válido.',
    'not_regex' => 'El formato del campo :attribute no es válido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato del campo :attribute no es válido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values están presentes.',
    'same' => 'El campo :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file' => 'El archivo :attribute debe tener :size kilobytes.',
        'string' => 'El campo :attribute debe tener :size caracteres.',
        'array' => 'El campo :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone' => 'El campo :attribute debe ser una zona válida.',
    'unique' => 'El campo :attribute ya ha sido tomado.',
    'uploaded' => 'El campo :attribute no se pudo cargar.',
    'url' => 'El formato del campo :attribute no es válido.',
    'uuid' => 'El campo :attribute debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Líneas de validación personalizadas
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar mensajes de validación personalizados para atributos utilizando
    | la convención "attribute.rule" para nombrar las líneas. Esto facilita la
    | especificación de una línea de lenguaje personalizada específica para una regla de atributo determinada.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'mensaje-personalizado',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de validación personalizados
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de lenguaje se utilizan para intercambiar el marcador de posición del atributo
    | por algo más fácil de leer, como "Dirección de correo electrónico" en lugar
    | de "email". Esto simplemente nos ayuda a hacer nuestro mensaje más expresivo.
    |
    */

    'attributes' => [],
    'custom-messages' => [
        'quantity_not_available' => 'Solo :qty :unit disponibles',
        'this_field_is_required' => 'Este campo es obligatorio'
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'name'                  => 'nombre',
        'username'              => 'usuario',
        'email'                 => 'correo electrónico',
        'first_name'            => 'nombre',
        'last_name'             => 'apellido',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'city'                  => 'ciudad',
        'country'               => 'país',
        'address'               => 'dirección',
        'phone'                 => 'teléfono',
        'mobile'                => 'móvil',
        'age'                   => 'edad',
        'sex'                   => 'sexo',
        'gender'                => 'género',
        'year'                  => 'año',
        'month'                 => 'mes',
        'day'                   => 'día',
        'hour'                  => 'hora',
        'minute'                => 'minuto',
        'second'                => 'segundo',
        'title'                 => 'título',
        'content'               => 'contenido',
        'body'                  => 'contenido',
        'description'           => 'descripción',
        'excerpt'               => 'extracto',
        'date'                  => 'fecha',
        'time'                  => 'hora',
        'subject'               => 'asunto',
        'message'               => 'mensaje',
    ],

];
