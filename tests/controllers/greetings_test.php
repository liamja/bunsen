<?php

use \GuzzleHttp\Psr7\Request;

/**
 * Greetings Controller Test
 *
 * @controller Greetings
 */
class GreetingsTest extends Bunsen\TestCase
{
    public function testIndex()
    {
        $request = new Request('GET', '/greetings/index');
        $this->send($request);
        $this->expectOutputRegex('/Many greetings to CodeIgniter/');
    }
}
