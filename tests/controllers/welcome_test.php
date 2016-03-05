<?php

use \GuzzleHttp\Psr7\Request;

/**
 * Welcome Controller Test
 *
 * @controller Welcome
 */
class WelcomeTest extends Bunsen\TestCase
{
    public function testTestMe()
    {
        $request = new Request('GET', 'welcome/testme');
        $this->makeRequest($request);
        $this->expectOutputString('Do I exist?');
    }

    public function testIndex()
    {
        $request = new Request('GET', 'welcome/index');
        $this->makeRequest($request);
        $this->expectOutputRegex('/Welcome to CodeIgniter/');
    }
}
