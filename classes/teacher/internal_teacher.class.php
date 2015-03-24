<?php

    /**
     * internal teacher class of Infomaniak
     *
     * @package internal teacher
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class internal_teacher extends teacher {

        /**
         * Gets salary
         *
         * @return string Teacher salary name
         */
        public function get_salary() {

            $salary = salary::get_instance();
            return $salary->get_amount();

        }

        /**
         * Loads teacher data
         * @param array $data Teacher data
         * @return Teacher object
         */
        public static function load($data) {
            return new self($data['first_name'], $data['last_name'], $data['id'], self::INTERNAL);
        }

    }
