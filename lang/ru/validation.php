<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'email' => 'Поле :attribute должно быть действительным адресом электронной почты.',
    'min' => [
        'string' => 'Поле :attribute должно содержать не менее :min символов.',
    ],
    'max' => [
        'string' => 'Поле :attribute должно содержать не более :max символов.',
    ],
    'unique' => 'Поле :attribute уже занято.',
    'confirmed' => 'Поле :attribute не совпадает.',
    'password' => 'Пароль неверен.',
    'attributes' => [
        'email' => 'E-mail',
        'password' => 'Пароль',
        'name' => 'Имя',
    ],
];
