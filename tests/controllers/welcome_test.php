<?php

class WelcomeTest extends Bunsen\ControllerTestCase
{
    public static function setUpBeforeClass()
    {
        self::loadController(\Welcome::class);
    }

    public function testTestMe()
    {
        $this->makeRequest(['welcome', 'testme']);
        $this->expectOutputString('Do I exist?');
    }

    public function testIndex()
    {
        $this->makeRequest(['welcome', 'index']);
        $this->expectOutputRegex('/Welcome to CodeIgniter/');
    }
}
