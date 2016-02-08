<?php

class GreetingsTest extends Bunsen\ControllerTestCase
{
    public static function setUpBeforeClass()
    {
        self::loadController(\Greetings::class);
    }

    public function testIndex()
    {
        $this->makeRequest(['greetings', 'index']);
        $this->expectOutputRegex('/Many greetings to CodeIgniter/');
    }
}
