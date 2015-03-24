<?php

    /**
     * PHPUnit Tests base class
     * Must be extended by every test class
     */
    class base extends PHPUnit_Framework_TestCase {

        /**
         * Loads general config
         *
         * @return void
         */
        public function load_config() {

            chdir(dirname(__FILE__));

            require_once '../config/start.php';

        }

    }
