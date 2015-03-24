<?php

    /**
     * student class of Infomaniak
     *
     * @package student
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class student extends storable {

        /**
         * Student first_name
         *
         * @var string
         */
        protected $first_name = '';

        /**
         * Student last_name
         *
         * @var string
         */
        protected $last_name = '';

        /**
         * Student id
         *
         * @var string
         */
        protected $id = 0;

        public function __construct($first_name, $last_name, $id = 0) {

            $this->set_first_name($first_name);
            $this->set_last_name($last_name);
            $this->set_id($id);

        }

        /**
         * Sets student first_name
         *
         * @param string $first_name Student first name
         * @return void
         */
        public function set_first_name($first_name) {
            check_string($first_name, 'first_name');
            $this->first_name = $first_name;
        }

        /**
         * Gets first_name
         *
         * @return string Student first name
         */
        public function get_first_name() {
            return $this->first_name;
        }

        /**
         * Sets student last_name
         *
         * @param string $last_name Student last name
         * @return void
         */
        public function set_last_name($last_name) {
            check_string($last_name, 'last_name');
            $this->last_name = $last_name;
        }

        /**
         * Gets last_name
         *
         * @return string Student last name
         */
        public function get_last_name() {
            return $this->last_name;
        }

        /**
         * Sets student id
         *
         * @param string $id Student id name
         * @return void
         */
        public function set_id($id) {
            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets id
         *
         * @return string Student id name
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Compare students
         *
         * @param student $student
         * @return boolean
         */
        public function are_students_equal(student $student) {

            if (0 !== $this->get_id()) {

                if ($this->get_id() == $student->get_id()) {
                    return true;
                }

            } else {

                if ($this->get_id() == $student->get_id() && $this->get_first_name() == $student->get_first_name() && $this->get_last_name() == $student->get_last_name()) {
                    return true;
                }

            }

            return false;

        }

        public static function load($data) {
            return new self($data['first_name'], $data['last_name'], $data['id']);
        }

    }
