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
         * game friend joker
         * @var string
         */
        protected $friend = '';


        /**
         * game public joker
         * @var string
         */
        protected $public = '';


        /**
         * game fifty joker
         * @var string
         */
        protected $fifty = '';

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

        /**
         * Sets friend
         *
         * @param int $friend
         */
        public function set_friend($friend) {
            $this->friend = $friend;
        }

        /**
         * Gets friend
         *
         * @return string
         */
        public function get_friend() {
            return $this->friend;
        }

        /**
         * Sets friend
         *
         * @param int $friend
         */
        public function setFriend($friend) {
            $this->friend = $friend;
        }

        /**
         * Gets friend
         *
         * @return string
         */
        public function getFriend() {
            return $this->friend;
        }

        /**
         * Sets public
         *
         * @param int $public
         */
        public function set_public($public) {
            $this->public = $public;
        }

        /**
         * Gets public
         *
         * @return string
         */
        public function get_public() {
            return $this->public;
        }

        /**
         * Sets public
         *
         * @param int $public
         */
        public function setPublic($public) {
            $this->public = $public;
        }

        /**
         * Gets public
         *
         * @return string
         */
        public function getPublic() {
            return $this->public;
        }

        /**
         * Sets fifty
         *
         * @param int $fifty
         */
        public function set_fifty($fifty) {
            $this->fifty = $fifty;
        }

        /**
         * Gets fifty
         *
         * @return string
         */
        public function get_fifty() {
            return $this->fifty;
        }

        /**
         * Sets fifty
         *
         * @param int $fifty
         */
        public function setFifty($fifty) {
            $this->fifty = $fifty;
        }

        /**
         * Gets fifty
         *
         * @return string
         */
        public function getFifty() {
            return $this->fifty;
        }

    }
