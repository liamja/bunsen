<?php

namespace Bunsen;

use GuzzleHttp\Psr7\Request;
use PHPUnit_Framework_TestCase;

/**
 * Controller Test Case
 */
abstract class TestCase extends PHPUnit_Framework_TestCase
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
     * @param Request $request
     * @internal param \string[] $requestParams Request URI
     */
    public function makeRequest(Request $request)
    {
        $this->forgeServerGlobal($request);

        ob_start();

        self::$ci->router->_set_request(explode('/', trim($request->getUri()->getPath(), '/')));
        call_user_func_array([static::$ci, static::$ci->uri->rsegments[1]], array_slice(static::$ci->uri->rsegments, 2));

        echo ob_get_clean();
    }

    /**
     * Call a function whilst trapping and returning any prints/echoes
     *
     * @param callable $callable
     * @return string
     */
    public function returnBuffer(callable $callable)
    {
        ob_start();
        $callable();
        return ob_get_clean();
    }

    /**
     * Take a request and update the $_SERVER global to match
     *
     * @param Request $request
     */
    private function forgeServerGlobal(Request $request)
    {
        $_SERVER['REQUEST_URI'] = $request->getUri()->getPath();
        $_SERVER['REQUEST_METHOD'] = $request->getMethod();
        $_SERVER['QUERY_STRING'] = $request->getUri()->getQuery();
    }
}
