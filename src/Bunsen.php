<?php

namespace Bunsen;

/**
 * Bootstrap
 */
class Bunsen
{
    public function bootstrap($indexPath = __DIR__ . '../../../index.php') {

        $indexPath = realpath($indexPath);

        if ($indexPath === false)
        {
            throw new PHPUnit_Framework_Exception('App path not found. Check the first parameter passed to Bunsen::bootstrap() points to the directory containing index.php.');
        }

        /**
         * Hook show_error to throw an exception PHPUnit can catch
         */
        \Patchwork\redefine('\show_error', function ($message, $status_code = 500, $heading = 'An Error Was Encountered') {
            \Patchwork\relay();
            throw new PHPUnit_Framework_Exception($heading . ' - ' . $message, $status_code);
        });

        /**
         * Hook show_404 to throw an exception PHPUnit can catch
         */
        \Patchwork\redefine('\show_404', function ($page = '', $log_error = true) {
            \Patchwork\relay();
            throw new PHPUnit_Framework_Exception($page, 404);
        });

        /**
         * Hook CI_Utf8::__construct to load the the Config class
         * into the $CFG superglobal.
         */
        \Patchwork\redefine('\CI_Utf8::__construct', function () {
            $GLOBALS['CFG'] = load_class('Config', 'core');
            \Patchwork\relay();
        });

        /**
         * Hook CI_Output::_display to load the Benchmark class
         * into the $BM superglobal.
         */
        \Patchwork\redefine('\CI_Output::_display', function () {
            $GLOBALS['BM'] = load_class('Benchmark', 'core');
            \Patchwork\relay();
        });

        /**
         * Bootstrap CodeIgniter
         *
         * Wrap the execution in a buffer to catch the initial request, then discard any output.
         * We can then trigger requests from tests.
         */
        ob_start();
        require_once $indexPath;
        ob_clean();

        /**
         * Autoload controllers
         */
        spl_autoload_register(function ($class) {
            $files = new \RecursiveDirectoryIterator(APPPATH . 'controllers');
            $files = new \RecursiveIteratorIterator($files, \RecursiveIteratorIterator::SELF_FIRST);
            $files = new \RegexIterator($files, '/\.php$/');

            foreach ($files as $file) {
                require_once $file;
            }
        });
    }
}
