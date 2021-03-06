<?php

    namespace Damarion\Domain;

    class Answer {

        /**
         * answer id
         *
         * @var int
         */
        protected $id = 0;

        /**
         * answer question_id
         *
         * @var int
         */
        protected $question_id = 0;

        /**
         * answer text
         *
         * @var string
         */
        protected $text = '';

        /**
         * answer right
         *
         * @var bool
         */
        protected $right = false;

        /**
         * answer active
         *
         * @var bool
         */
        protected $active = true;

        /**
         * Associated question
         *
         * @var object question
         */
        protected $question = NULL;

        /**
         * Questions list
         *
         * @var array question list
         */
        protected $question_list = array();

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
         * Sets text
         *
         * @param string $text
         */
        public function set_text($text) {
            $this->text = $text;
        }

        /**
         * Gets text
         *
         * @return string
         */
        public function get_text() {
            return $this->text;
        }

        /**
         * Sets right
         *
         * @param bool $right
         */
        public function set_right($right) {
            $this->right = $right;
        }

        /**
         * Gets right
         *
         * @return bool
         */
        public function get_right() {
            return $this->right;
        }

        /**
         * Sets active
         *
         * @param bool $active
         */
        public function set_active($active) {
            $this->active = $active;
        }

        /**
         * Gets active
         *
         * @return bool
         */
        public function get_active() {
            return $this->active;
        }

        /**
         * Sets question id
         *
         * @param int $question_id
         */
        public function setQuestionId($question_id) {
            $this->question_id = $question_id;
        }

        /**
         * Gets question id
         *
         * @return int
         */
        public function getQuestionId() {
            return $this->question_id;
        }

        /**
         * Sets text
         *
         * @param string $text
         */
        public function setText($text) {
            $this->text = $text;
        }

        /**
         * Gets text
         *
         * @return string
         */
        public function getText() {
            return $this->text;
        }

        /**
         * Sets right
         *
         * @param bool $right
         */
        public function setRight($right) {
            $this->right = $right;
        }

        /**
         * Gets right
         *
         * @return bool
         */
        public function getRight() {
            return $this->right;
        }

        /**
         * Sets active
         *
         * @param bool $active
         */
        public function setActive($active) {
            $this->active = $active;
        }

        /**
         * Gets active
         *
         * @return bool
         */
        public function getActive() {
            return $this->active;
        }

        /**
         * Sets question
         *
         * @param int $question
         */
        public function set_question($question) {
            $this->question = $question;
        }

        /**
         * Gets question
         *
         * @return int
         */
        public function get_question() {
            return $this->question;
        }

        /**
         * Sets questions_list
         *
         * @param int $questions_list
         */
        public function set_questions_list($questions_list) {
            $this->questions_list = $questions_list;
        }

        /**
         * Gets questions_list
         *
         * @return int
         */
        public function get_questions_list() {
            return $this->questions_list;
        }

    }
