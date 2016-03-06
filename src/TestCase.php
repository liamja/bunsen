<?php

namespace Bunsen;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
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

        return $this;
    }

    /**
     * Make an HTTP request
     *
     * @param RequestInterface $request
     */
    public function send(RequestInterface $request)
    {
        $this->forgeServerGlobal($request);
        $this->forgeUri($request->getUri());

        echo $this->returnBuffer([static::$ci, static::$ci->uri->rsegments[1]], array_slice(static::$ci->uri->rsegments, 2));

        return $this;
    }

    /**
     * Call a function whilst trapping and returning any prints/echoes
     *
     * @param callable $callable Function to trap
     * @param array    $args     Arguments to $callable
     * @return string            Trapped prints/echoes from $callable
     */
    public function returnBuffer(callable $callable, array $args)
    {
        ob_start();
        $callable(...$args);
        return ob_get_clean();
    }

    /**
     * Take a request and update the $_SERVER global to match
     *
     * @param RequestInterface $request
     */
    private function forgeServerGlobal(RequestInterface $request)
    {
        $_SERVER['REQUEST_URI'] = $request->getUri()->getPath();
        $_SERVER['REQUEST_METHOD'] = $request->getMethod();
        $_SERVER['QUERY_STRING'] = $request->getUri()->getQuery();

        if ($request->hasHeader('Content-Type')) {
            $_SERVER['CONTENT_TYPE'] = $request->getHeaderLine('Content-Type');
        }
        if ($request->hasHeader('Referer')) {
            $_SERVER['HTTP_REFERER'] = $request->getHeaderLine('Referer');
        }
        if ($request->hasHeader('X-Requested-with')) {
            $_SERVER['HTTP_X_REQUESTED_WITH'] = $request->getHeaderLine('X-Requested-With');
        }
        if ($request->hasHeader('User-Agent')) {
            $_SERVER['HTTP_USER_AGENT'] = $request->getHeaderLine('User-Agent');
        }
        if ($request->hasHeader('X-Forwarded-For')) {
            $_SERVER['HTTP_X_FORWARDED_FOR'] = $request->getHeaderLine('X-Forwarded-For');
        }

        return $this;
    }

    /**
     * Take a request URI and update the CI URI object state to match
     *
     * @param UriInterface $uri
     */
    private function forgeUri(UriInterface $uri)
    {
        static::$ci->router->_set_request(explode('/', trim($uri->getPath(), '/')));

        return $this;
    }
}
