<?php
/**
* Check if var is a string
*
* @param string $string var to be tested
* @param string $name name of var
* @return NULL
*/

    /**
     * Loads config
     *
     * @return void
     */
    function load_config() {
        require substr(dirname(__FILE__), 0, -8) . 'config/config.php';
    }

    /**
     * Loads class
     *
     * @param string $string
     * @param string $name
     * @return void
     */
    function load_class($classname) {

        try {

            global $dConfig;

            switch($classname) {

                case false !== strpos($classname, '_teacher'):
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . 'teacher/' . $classname . '.class.php';
                    break;

                case false !== strpos($classname, 'Exception'):
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . 'exception/' . $classname . '.class.php';
                    break;

                default :
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . $classname . '/' . $classname . '.class.php';
                    break;
            }

        } catch (Exception $e) {
            dump($e);
        }

    }

    /**
     * Dumps data
     *
     * @param misc $var
     * @param string $description
     * @return void
     */
    function dump($var, $description = '') {

        echo "\r\n" . $description . "\r\n";
        echo '<pre>';
        var_dump($var);
        echo "</pre>\r\n";

    }

    /**
     * Checks if data is string
     *
     * @param string $string
     * @param string $name
     * @return void
     */
    function check_string($string, $name, $empty_allowed = true) {

        if (!is_string($string)) {
            throw new InvalidArgumentException($name . " must be a string.", 1);
        }

        if (!$empty_allowed && $string == '') {
            throw new InvalidArgumentException($name . ' must not be empty');
        }

    }

    /**
     * Checks if data is int
     *
     * @param int $int
     * @param string $name
     * @return void
     */
    function check_int($int, $name, $empty_allowed = true) {

        if (!is_int($int)) {
            throw new InvalidArgumentException($name . " must be a int.", 1);
        }

        if (!$empty_allowed && NULL == $int) {
            throw new InvalidArgumentException($name . ' must not be empty');
        }

    }

    /**
     * Checks if data is array
     *
     * @param array $array
     * @param string $name
     * @return void
     */
    function check_array($array, $name, $empty_allowed = true) {

        if (!is_array($array)) {
            throw new InvalidArgumentException($name . " must be a array.", 1);
        }

        if (!$empty_allowed && empty($array)) {
            throw new InvalidArgumentException($name . ' must not be empty');
        }

    }

    /**
     * Checks if data is object
     *
     * @param object $object
     * @param string $name
     * @return void
     */
    function check_object($object, $name, $empty_allowed = true) {

        if (!is_object($object)) {
            throw new InvalidArgumentException($name . " must be a object.", 1);
        }

        if (!$empty_allowed && empty($object)) {
            throw new InvalidArgumentException($name . ' must not be empty');
        }

    }

