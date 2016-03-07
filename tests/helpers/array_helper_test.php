<?php

class Array_Helper_Test extends Bunsen\TestCase
{
    public function setUp()
    {
        parent::setUp();
        self::$ci->load->helper('array');
    }

    public function testElement()
    {
        $array = array('color' => 'red', 'shape' => 'round', 'size' => '');

        $this->assertEquals('red', element('color', $array));
        $this->assertNull(element('size', $array, NULL));
    }

    public function testRandomElement()
    {
        $quotes = array(
            "I find that the harder I work, the more luck I seem to have. - Thomas Jefferson",
            "Don't stay in bed, unless you can make money in bed. - George Burns",
            "We didn't lose the game; we just ran out of time. - Vince Lombardi",
            "If everything seems under control, you're not going fast enough. - Mario Andretti",
            "Reality is merely an illusion, albeit a very persistent one. - Albert Einstein",
            "Chance favors the prepared mind - Louis Pasteur"
        );

        $this->assertRegExp('/\s(Jefferson|Burns|Lombardi|Andretti|Einstein|Pasteur)$/', random_element($quotes));
    }

    public function testElements()
    {
        $array = array(
            'color' => 'red',
            'shape' => 'round',
            'radius' => '10',
            'diameter' => '20'
        );

        $my_shape = elements(array('color', 'shape', 'height'), $array);

        $this->assertEquals(array(
            'color' => 'red',
            'shape' => 'round',
            'height' => FALSE
        ), $my_shape);

        $my_shape = elements(array('color', 'shape', 'height'), $array, NULL);

        $this->assertEquals(array(
            'color' => 'red',
            'shape' => 'round',
            'height' => NULL
        ), $my_shape);
    }
}
