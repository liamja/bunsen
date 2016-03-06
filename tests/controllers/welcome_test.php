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
        $this->send($request);
        $this->expectOutputString('Do I exist?');
    }

    public function testIndex()
    {
        $request = new Request('GET', 'welcome/index');
        $this->send($request);
        $this->expectOutputRegex('/Welcome to CodeIgniter/');
    }

    public function testIsAjax()
    {
        $request = new Request('GET', 'welcome/is_ajax');
        $this->send($request);
        $this->expectOutputRegex('/false/');

        $request = (new Request('GET', 'welcome/is_ajax'))->withHeader('X-Requested-With', 'XMLHttpRequest');
        $this->send($request);
        $this->expectOutputRegex('/true/');
    }
}
