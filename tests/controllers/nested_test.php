<?php

/**
 * Nested Controller Test
 *
 * @controller Nested
 */
class NestedTest extends Bunsen\ControllerTestCase
{
    public function testIndex()
    {
        $this->makeRequest(['folder', 'nested', 'index']);
        $this->expectOutputRegex('/I am nested\./');
    }
}
