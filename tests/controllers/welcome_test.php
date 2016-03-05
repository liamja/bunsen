<?php

/**
 * Welcome Controller Test
 *
 * @controller Welcome
 */
class WelcomeTest extends Bunsen\TestCase
{
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
