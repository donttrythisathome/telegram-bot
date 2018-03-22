<?php

namespace Dtth\TelegramBot\Models;

use Dtth\TelegramBot\Models\Message;
use Dtth\TelegramBot\Models\AbstractModel;

class Update extends AbstractModel
{
    protected $relations = [
        'message'=>Message::class,
        'inline_query' => InlineQuery::class,
        'edited_message' => EditedMessage::class,
        'callback_query' => CallbackQuery::class,
        'chosen_inline_result' => ChosenInlineResult::class,
    ];
}