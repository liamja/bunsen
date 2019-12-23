<?php

use PHPUnit\Framework\TestCase;

class Email_Helper_Test extends TestCase
{
    /**
     * @var \CI_Controller
     */
    private $ci;

    public function setUp()
    {
        $this->ci = get_instance();
        $this->ci->load->helper('email');
    }

    public function testEmailValidation()
    {
        $this->assertTrue(valid_email('test@test.com'));
        $this->assertFalse(valid_email('test#testcom'));
    }
}
