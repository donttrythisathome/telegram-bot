<?php

namespace Dtth\TelegramBot\Tests;

use Dtth\TelegramBot\BotManager;
use Dtth\TelegramBot\Bots\Bot;
use PHPUnit_Framework_TestCase;

class BotTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setting up test case.
     *
     * @return void
     */
    public function setUp()
    {
        $config = require (__DIR__.'/../config/config.php');
        $this->manager = new BotManager($config);
    }
    /**
     * Test the bot manager "bot" method.
     *
     * @return void
     */
    public function testBotMethod()
    {
        $this->assertInstanceOf(Bot::class,$this->manager->bot());
    }
}
