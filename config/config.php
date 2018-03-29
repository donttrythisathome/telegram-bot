<?php

return [
    'url'=>env('TELEGRAM_BOT_URL','https://api.telegram.org/bot<token>/METHOD_NAME'),
    'bots'=>[
        'bot'=>[
            'class'=>\Dtth\TelegramBot\Bots\DefaultBot::class,
            'token'=>'595689596:AAENPFdlYOLx532NBHT8Ieqd8wsbn-NKYlI',
            'name'=>'bot',
            'webhook'=>'dtth'
        ]
    ],
    'default'=> 'bot'
];