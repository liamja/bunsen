<?php

use GuzzleHttp\Psr7\Request;

/**
 * Nested Controller Test
 *
 * @controller Nested
 */
class NestedTest extends Bunsen\TestCase
{
    public function testIndex()
    {
        $request = new Request('GET', '/folder/nested/index');
        $this->send($request);
        $this->expectOutputRegex('/I am nested\./');
    }
}
