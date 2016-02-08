<?php

namespace Bunsen;

use Patchwork\Exceptions\Exception as PatchworkException;
use PHPUnit_Framework_TestCase;

/**
 * Controller Test Case
 */
abstract class ControllerTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var \CI_Controller
     */
    protected static $ci;

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * @inheritdoc
     *
     * Fetch and instantiate the controller to test.
     */
    protected function setUp()
    {
        $antns = $this->getAnnotations();

        if (!empty($antns['class']['method'][0])) {
            static::$ci = new $antns['class']['method'][0];
        } elseif (!empty($antns['class']['controller'][0])) {
            static::$ci = new $antns['class']['controller'][0];
        }
    }

    /**
     * Make a request to the controller
     *
     * @param string[] $requestParams Request URI
     */
    public function makeRequest(array $requestParams)
    {
        ob_start();

        self::$ci->router->_set_request($requestParams);
        call_user_func_array([static::$ci, static::$ci->uri->rsegments[1]], array_slice(static::$ci->uri->rsegments, 2));

        echo ob_get_clean();
    }
}
