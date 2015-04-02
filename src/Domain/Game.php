<?php

    namespace Damarion\Domain;

    class Game {

        /**
         * game id
         * @var int
         */
        protected $id = 0;

        /**
         * game title
         * @var string
         */
        protected $title = '';

        /**
         * Sets id
         *
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
         * Sets title
         *
         * @param int $title
         */
        public function set_title($title) {
            $this->title = $title;
        }

        /**
         * Gets title
         *
         * @return string
         */
        public function get_title() {
            return $this->title;
        }

        /**
         * Sets title
         *
         * @param int $title
         */
        public function setTitle($title) {
            $this->title = $title;
        }

        /**
         * Gets title
         *
         * @return string
         */
        public function getTitle() {
            return $this->title;
        }

    }
