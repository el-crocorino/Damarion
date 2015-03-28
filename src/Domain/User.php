<?php

    namespace Damarion\Domain;

    class User {

        /**
         * User id
         * @var int
         */
        protected $id = 0;

        /**
         * User username
         * @var string
         */
        protected $username = '';

        /**
         * Sets id
         * @param int $id
         */
        public function set_id($id) {
            $this->id = $id;
        }

        /**
         * Gets id
         *
         * @return int
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets username
         * @param int $username
         */
        public function set_username($username) {
            $this->username = $username;
        }

        /**
         * Gets username
         *
         * @return string
         */
        public function get_username() {
            return $this->username;
        }

    }
