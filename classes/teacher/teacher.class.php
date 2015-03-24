<?php

    /**
     * teacher class of Infomaniak
     *
     * @package teacher
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    abstract class teacher extends storable {

        /**
         * Teacher first_name
         *
         * @var string
         */
        protected $first_name = '';

        /**
         * Teacher last_name
         *
         * @var string
         */
        protected $last_name = '';

        /**
         * Teacher id
         *
         * @var string
         */
        protected $id = 0;

        /**
         * Teacher type
         *
         * @var string
         */
        protected $type = 0;

        const INTERNAL = 0;
        const EXTERNAL = 1;

        public function __construct($first_name, $last_name, $id, $type) {

            $this->set_first_name($first_name);
            $this->set_last_name($last_name);
            $this->set_id($id);
            $this->set_type($type);

        }

        /**
         * Sets teacher first_name
         *
         * @param string $first_name Teacher first_name name
         * @return void
         */
        public function set_first_name($first_name) {
            check_string($first_name, 'first_name');
            $this->first_name = $first_name;
        }

        /**
         * Gets first_name
         *
         * @return string Teacher first_name name
         */
        public function get_first_name() {
            return $this->first_name;
        }

        /**
         * Sets teacher last_name
         *
         * @param string $last_name Teacher last_name name
         * @return void
         */
        public function set_last_name($last_name) {
            check_string($last_name, 'last_name');
            $this->last_name = $last_name;
        }

        /**
         * Gets last_name
         *
         * @return string Teacher last_name names
         */
        public function get_last_name() {
            return $this->last_name;
        }

        /**
         * Sets teacher id
         *
         * @param string $id Teacher id name
         * @return void
         */
        public function set_id($id) {
            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets id
         *
         * @return string Teacher id name
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets teacher type
         *
         * @param string $type Teacher type name
         * @return void
         */
        public function set_type($type) {
            check_int($type, 'type');
            $this->type = $type;
        }

        /**
         * Gets type
         *
         * @return string Teacher type name
         */
        public function get_type() {
            return $this->type;
        }

    }
