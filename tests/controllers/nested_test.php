<?php

class NestedTest extends Bunsen\ControllerTestCase
{
    public static function setUpBeforeClass()
    {
        self::loadController(\Nested::class);
    }

    public function testIndex()
    {
        $this->makeRequest(['folder', 'nested', 'index']);
        $this->expectOutputRegex('/I am nested\./');
    }
}
