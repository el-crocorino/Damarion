<?php

    /**
     * salary class of Infomaniak
     *
     * @package salary
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class salary extends storable {

        /**
         * Salary object instance
         *
         * @var null
         */
        protected static $instance = NULL;

        /**
         * Salary amount
         *
         * @var object
         */
        protected $amount = 2500;

        private function __construct() {

        }

        /**
         * Gets salary instance
         *
         * @return salary object
         */
        public static function get_instance() {

            if (!isset(self::$instance)) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Sets Salary amount
         *
         * @param string $amount Salary amount name
         * @return void
         */
        public function set_amount($amount) {
            check_int($amount, 'amount');
            $this->amount = $amount;
        }

        /**
         * Gets amount
         *
         * @return string Salary amount name
         */
        public function get_amount() {
            return $this->amount;
        }

    }
