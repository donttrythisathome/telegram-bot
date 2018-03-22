<?php

/*
 * Telegram bot Api webhook route
 */
Route::get(config('telegram_bot.webhook'), 'App\Http\Controllers\TelegramBotController@update')->name('bot_update');