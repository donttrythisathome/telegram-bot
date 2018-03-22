<?php

namespace Dtth\TelegramBot\Models;

use Dtth\TelegramBot\Models\AbstractModel;

class Message extends AbstractModel
{
    protected $relations = [
        'from'=> User::class,
        'chat' => Chat::class,
        'forward_from' => User::class,
        'forward_from_chat'=> User::class,
        'reply_to_message' => Message::class,
        'entities' => MessageEntity::class,
        'audio' => Audio::class,
        'document' => Document::class,
        'photo' => PhotoSize::class,
        'sticker' => Sticker::class,
        'video' => Video::class,
        'voice' => Voice::class,
        'contact' => Contact::class,
        'location' => Location::class,
        'venue' => Venue::class,
        'new_chat_member' => User::class,
        'left_chat_member' => User::class,
        'new_chat_photo' => PhotoSize::class,
        'pinned_message' => Message::class,
    ];
}