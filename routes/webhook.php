<?php

/*
 * Telegram bot Api webhook route
 */
Route::any(config('telegram_bot.webhook'), 'App\Http\Controllers\TelegramBotController@update')->name('bot_update');