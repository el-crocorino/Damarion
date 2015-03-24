<?php

    /**
     * external teacher class of Infomaniak
     *
     * @package external teacher
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class external_teacher extends teacher {

        /**
         * Teacher salary
         *
         * @var string
         */
        protected $salary = 0;

        public function __construct($first_name, $last_name, $id, $type, $salary) {
            $this->set_salary($salary);
            parent::__construct($first_name, $last_name, $id, $type);
        }

        /**
         * Sets teacher salary
         *
         * @param string $salary Teacher salary name
         * @return void
         */
        public function set_salary($salary) {
            check_int($salary, 'salary');
            $this->salary = $salary;
        }

        /**
         * Gets salary
         *
         * @return string Teacher salary name
         */
        public function get_salary() {
            return $this->salary;
        }

        /**
         * Loads teacher data
         * @param array $data Teacher data
         * @return Teacher object
         */
        public static function load($data) {
            return new self($data['first_name'], $data['last_name'], $data['id'], self::EXTERNAL, $data['salary']);
        }

    }
