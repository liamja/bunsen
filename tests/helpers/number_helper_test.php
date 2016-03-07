<?php

class Number_Helper_Test extends Bunsen\TestCase
{
    public function setUp()
    {
        parent::setUp();
        self::$ci->load->helper('number');
    }

    public function testElement()
    {
        $this->assertEquals('456 Bytes', byte_format(456));
        $this->assertEquals('4.5 KB', byte_format(4567));
        $this->assertEquals('44.6 KB', byte_format(45678));
        $this->assertEquals('447.8 KB', byte_format(456789));
        $this->assertEquals('3.3 MB', byte_format(3456789));
        $this->assertEquals('1.8 GB', byte_format(12345678912345));
        $this->assertEquals('11,228.3 TB', byte_format(123456789123456789));

        $this->assertEquals('44.61 KB', byte_format(45678, 2));
    }
}
