<?php

class Email_Helper_Test extends Bunsen\TestCase
{
    public function setUp()
    {
        parent::setUp();
        self::$ci->load->helper('email');
    }

    public function testEmailValidation()
    {
        $this->assertTrue(valid_email('test@test.com'));
        $this->assertFalse(valid_email('test#testcom'));
    }
}
