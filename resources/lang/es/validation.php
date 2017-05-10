<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute debe ser aceptado.',
    'active_url'           => ':attribute no es una URL válida.',
    'after'                => ':attribute debe ser una fecha posterior a :date.',
    'alpha'                => ':attribute solo debe contener letras.',
    'alpha_dash'           => ':attribute solo debe contener letras, números y guiones.',
    'alpha_num'            => ':attribute solo debe contener letras y números.',
    'array'                => ':attribute debe ser un conjunto.',
    'before'               => ':attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => ':attribute tiene que estar entre :min - :max.',
        'file'    => ':attribute debe pesar entre :min - :max kilobytes.',
        'string'  => ':attribute tiene que tener entre :min - :max caracteres.',
        'array'   => ':attribute tiene que tener entre :min - :max ítems.',
    ],
    'boolean'              => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => ':attribute no es una fecha válida.',
    'date_format'          => ':attribute no corresponde al formato :format.',
    'different'            => ':attribute y :other deben ser diferentes.',
    'digits'               => ':attribute debe tener :digits dígitos.',
    'digits_between'       => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'Las dimensiones de la imagen :attribute no son validas.',
    'distinct'             => 'El campo :attribute contiene un valor duplicado.',
    'email'                => ':attribute no es un correo válido',
    'exists'               => ':attribute es inválido.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => ':attribute debe ser una imagen.',
    'in'                   => ':attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => ':attribute debe ser un número entero.',
    'ip'                   => ':attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
    'max'                  => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file'    => ':attribute no debe ser mayor que :max kilobytes.',
        'string'  => ':attribute no debe ser mayor que :max caracteres.',
        'array'   => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => ':attribute debe ser un archivo con formato: :values.',
    'min'                  => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string'  => ':attribute debe contener al menos :min caracteres.',
        'array'   => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => ':attribute es inválido.',
    'numeric'              => ':attribute debe ser numérico.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato de :attribute es inválido.',
    'packages.required'    => 'Debe seleccionar al menos un paquete', 
    'required'             => 'El campo :attribute es obligatorio.',
    //'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if'          => 'El campo :attribute es obligatorio.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => ':attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string'  => ':attribute debe contener :size caracteres.',
        'array'   => ':attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => ':attribute ya ha sido registrado.',
    'url'                  => 'El formato :attribute es inválido.',

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

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'select_diaryid'          => [
            'unique'  => ':attribute ya ha sido agendado.']
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
        'lastname'              => 'Apellido',
        'status'                => 'Estatus',
        'username'              => 'usuario',
        'email'                 => 'correo electrónico',
        'first_name'            => 'nombre',
        'last_name'             => 'apellidos',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'city'                  => 'ciudad',
        'country'               => 'país',
        'address'               => 'dirección',
        'phone'                 => 'teléfono',
        'mobile'                => 'móvil',
        'phone_mobile'          => 'Télefono movil',
        'role_id'               => 'Rol',
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
        'body'                  => 'contenido',
        'description'           => 'descripción',
        'excerpt'               => 'extracto',
        'date'                  => 'fecha',
        'time'                  => 'hora',
        'subject'               => 'asunto',
        'message'               => 'mensaje',
        'accept_terms'          => 'Términos y condiciones',
        'packages'              => 'Paquetes',
        'payment_method_id'     => 'Método de Pago',
        'reference'             => 'Referencia',
        'amount'                => 'Cantidad',
        'role'                  => 'Rol',
        'start'                 => 'Inicio vigencia',
        'end'                   => 'Fin vigencia',
        'start_date'            => 'Inicio vigencia',
        'end_date'              => 'Fin vigencia',
        'company'               => 'Compañia',
        'detail'                => 'Detalles',
        'limits'                => 'Limites',
        'limit'                 => 'Limitaciones',
        'limit_id'              => 'Limitaciones',
        'mail_type_id'          => 'Tipo de plantilla',
        'hour_alarm'            => 'Hora de alarma',
        'date_alarm'            => 'Fecha de alarma',
        'content'               => 'Contenido',
        'supervisor_id'         => 'Supervisor',
        'commission'            => 'Comisión',
        'select_diaryid'        => 'El ID',
        'prm_nombre'            => 'Nombre', 
        'prm_fecha_desde'       => 'Inicio Vigencia', 
        'prm_fecha_hasta'       => 'Fin Vigencia', 
        'prm_max_edad'          => 'Edad maxima',
        'prm_min_edad'          => 'Edad minima',
        'prm_max_pasajeros'     => 'Maximo pasajeros',
        'prv_codigo'            => 'Compañia',
        'prm_tipo'              => 'Tipo',
        'prm_porcentaje'        => 'Porcentaje',
        'send_mode'             => 'Modo de envío',
        'seller_id'             => 'Vendedor',
        'model_id'              => 'ID',
        'passenger_code'        => 'Pasajero',
        'cot_origen'            => 'Origen',
        'cot_destino'           => 'Destino',
        'cot_regreso'           => 'Regreso',
        'cot_salida'            => 'Salida',
        'cot_email'             => 'Email',
        'cot_edades'            => 'Edades',
        'if_condition'          => 'Términos y Condiciones',
        'contact_name'          => 'Nombre de contacto',
        'contact_email'         => 'Email de contacto',
        'contact_phone'         => 'Télefono de contacto',
        'card_method'           => 'Pago con tarjeta',
        'type_dni'              => 'Tipo de documento',
    ],

];

