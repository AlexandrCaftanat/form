<?php
$fields = [
    
    'name' => [
        'field_name' => 'Имя',
        'requiered' => 1,
        'mailable' => 1,

    ],
    'email' => [
        'field_name' => 'Емайл',
        'requiered' => 1,
        'mailable' => 1,
    ],
    'address' => [
        'field_name' => 'Адресс',
        'requiered' => 0,
        'mailable' => 1,
    ],
    'phone' => [
        'field_name' => 'Телефон',
        'requiered' => 1,
        'mailable' => 1,
    ],
    'comment' => [
        'field_name' => 'Комментарий',
        'requiered' => 0,
        'mailable' => 1,
    ],
    'agree' => [
        'field_name' => 'Согласие на абработку персонаьных данных',
        'requiered' => 1,
        'mailable' => 0,
    ],
    'captcha' => [
        'field_name' => 'Сaptcha',
        'requiered' => 1,
        'mailable' => 0,
    ],
    
];

$mail_settings = [
            'host' => 'smtp.mailtrap.io',
            'username' => '45ef11ac930dc1',
            'password' => '8d5b78b6880881',
            'port' => '2525',
            'smtp_auth' => true,
            'smtp_secure' =>null,
            'from_email' => 'caa4a2ddc9-e4faaf@inbox.mailtrap.io',
            'from_name' => 'My site',
            'to_email' => 'user@mail.com'
];