<?php

class Directory_Helper_Test extends Bunsen\TestCase
{
    public function setUp()
    {
        parent::setUp();
        self::$ci->load->helper('directory');
    }

    public function testDirectoryMap()
    {
        $this->assertEquals(array(
            'Cache.php',
            'drivers' => array(
                'Cache_apc.php',
                'Cache_dummy.php',
                'Cache_file.php',
                'Cache_memcached.php'
            )
        ), directory_map('./system/libraries/Cache'));
    }
}
