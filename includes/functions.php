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

                case false !== strpos($classname, '_orm'):
                    $classname = substr($classname, 0, -4);
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . $classname . '/' . $classname . '_orm.class.php';
                    break;

                case false !== strpos($classname, 'manager'):
                    $classname = substr($classname, 0, -7);
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . $classname . '/' . $classname . 'manager.class.php';
                    break;

                case false !== strpos($classname, 'Exception'):
                    require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . 'exception/' . $classname . '.class.php';
                    break;

                default :

                    if (file_exists($dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . $classname . '/' . $classname . '_orm.class.php')) {
                        require_once $dConfig['paths']['base_path'] . $dConfig['paths']['classes'] . $classname . '/' . $classname . '_orm.class.php';
                    }

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
     * Checks if data is bool
     *
     * @param bool $bool
     * @param string $name
     * @return void
     */
    function check_bool($bool, $name, $empty_allowed = true) {

        if (!is_bool($bool)) {
            throw new InvalidArgumentException($name . " must be a bool.", 1);
        }

        if (!$empty_allowed && NULL == $bool) {
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

    /**
    * Prefixes an array with given prefix
    *
    * @param string $prefix Prefix
    * @param array $array Array to prefix
    * @param boolean $recursive Optional
    * @return array Prefixed array
    */
    function array_prefix($prefix, $array, $recursive = true) {

        check_string($prefix, 'prefix');
        check_array($array, 'array');
        check_bool($recursive, 'recursive');

        $tmp = array();

        foreach ($array AS $key => $value) {

            if (is_int($key) && is_array($value) && $recursive === true) {
                $tmp[$key] = array_prefix($prefix, $value, $recursive);
            } elseif (!is_int($key) && is_array($value) && $recursive === true) {
                $tmp[$prefix . $key] = array_prefix($prefix, $value, $recursive);
            } elseif (!is_int($key)) {
                $tmp[$prefix . $key] = $value;
            } else {
                $tmp[$key] = $value;
            }

        }

        return $tmp;

    }


    /**
    * Removes prefixes in array
    *
    * @param string $prefix Prefix
    * @param array $array Prefixed array
    * @param boolean $recursive Optional
    * @return array Unfixed array
    */
    function array_unfix($prefix, $array, $recursive = true) {

        check_string($prefix, 'prefix');
        check_array($array, 'array');
        check_bool($recursive, 'recursive');

        $tmp = array();

        foreach ($array AS $key => $value) {

            if (is_int($key) && is_array($value) && $recursive === true) {
                $tmp[$key] = array_unfix($prefix, $value, $recursive);
            } elseif (!is_int($key) && is_array($value) && $recursive === true) {

                if (substr($key, 0, strlen($prefix)) == $prefix) {
                    $tmp[substr($key, strlen($prefix))] = array_unfix($prefix, $value, $recursive);
                }

            } elseif (!is_int($key)) {

                if (substr($key, 0, strlen($prefix)) == $prefix) {
                    $tmp[substr($key, strlen($prefix))] = $value;
                } else {
                    $tmp[$key] = $value;
                }

            } else {
                $tmp[$key] = $value;
            }

        }

        return $tmp;

    }


    /**
    * Extracts array items into another array by key prefix
    *
    * @param string $prefix Prefix
    * @param array $array Array
    * @return array Extracted data
    */
    function array_extract($prefix, $array) {

        check_string($prefix, 'prefix');
        check_array($array, 'array');

        $result = array();
        $prefix_length = strlen($prefix);

        foreach ($array AS $key => $v) {

            if (substr($key, 0, $prefix_length) == $prefix) {
                $result[$key] = $value;
            }

        }

        if (count($result) > 0) {
            return $result;
        }

        return NULL;

    }

