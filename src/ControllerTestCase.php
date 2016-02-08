<?php

namespace Bunsen;

/**
 * Controller Test Case
 */
abstract class ControllerTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \CI_Controller
     */
    protected static $ci;

    /**
     * Fetch and instantiate the controller to test
     *
     * Wrap instantiation in an output buffer to catch errors.
     *
     * @param string $controller Namespaced controller to load
     */
    protected static function loadController($controller)
    {
        ob_start();
        static::$ci = new $controller;
        ob_clean();
    }

    /**
     * Make a request to the controller
     *
     * @params string[] $requestParams Request URI
     */
    public function makeRequest(array $requestParams)
    {
        ob_start();

        self::$ci->router->_set_request($requestParams);
        call_user_func_array([static::$ci, static::$ci->uri->rsegments[1]], array_slice(static::$ci->uri->rsegments, 2));

        echo ob_get_clean();
    }
}