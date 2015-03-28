<?php

    namespace Damarion\Domain;

    class Vote {

        /**
         * vote id
         * @var int
         */
        protected $id = 0;

        /**
         * vote user_id
         * @var int
         */
        protected $user_id = 0;

        /**
         * vote question_id
         * @var string
         */
        protected $question_id = 0;

        /**
         * vote answer_id
         * @var int
         */
        protected $answer_id = 0;

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
         * Sets user id
         *
         * @param int $user_id
         */
        public function set_user_id($user_id) {
            $this->user_id = $user_id;
        }

        /**
         * Gets user id
         *
         * @return int
         */
        public function get_user_id() {
            return $this->user_id;
        }

        /**
         * Sets question id
         *
         * @param int $question_id
         */
        public function set_question_id($question_id) {
            $this->question_id = $question_id;
        }

        /**
         * Gets question id
         *
         * @return int
         */
        public function get_question_id() {
            return $this->question_id;
        }

        /**
         * Sets answer id
         *
         * @param int $answer_id
         */
        public function set_answer_id($answer_id) {
            $this->answer_id = $answer_id;
        }

        /**
         * Gets answer id
         *
         * @return int
         */
        public function get_answer_id() {
            return $this->answer_id;
        }

    }