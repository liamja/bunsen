<?php

/**
 * Greetings Controller Test
 *
 * @controller Greetings
 */
class GreetingsTest extends Bunsen\ControllerTestCase
{
    public function testIndex()
    {
        $this->makeRequest(['greetings', 'index']);
        $this->expectOutputRegex('/Many greetings to CodeIgniter/');
    }
}
