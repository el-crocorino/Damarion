<?php

    namespace Damarion\Domain;

    use Doctrine\Common\Collections\ArrayCollection;

    class Question  {

        /**
         * question id
         *
         * @var int
         */
        protected $id = 0;

        /**
         * question game_id
         *
         * @var int
         */
        protected $game_id = 0;

        /**
         * question text
         *
         * @var bool
         */
        protected $active = false;

        /**
         * question text
         *
         * @var string
         */
        protected $text = '';

        /**
         * question order
         *
         * @var int
         */
        protected $order = 0;

        /**
         * question order
         *
         * @var int
         */
        protected $game = 0;

        /**
         * question answers
         *
         * @var array
         */
        protected $answers = array();

        /**
         * Sets Id
         *
         * @param int $id
         */
        public function set_id($id) {
            $this->id = $id;
        }

        /**
         * Returns $id
         *
         * @return int
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets Game id
         *
         * @param int $game_id
         */
        public function set_game_id($game_id) {
            $this->game_id = $game_id;
        }

        /**
         * Gets Game id
         *
         * @return int
         */
        public function get_game_id() {
            return $this->game_id;
        }

        /**
         * Sets active parameter
         *
         * @param boolean $active
         */
        public function set_active($active) {
            $this->active = $active;
        }

        /**
         * Gets active parameter
         *
         * @return bool
         */
        public function get_active() {
            return $this->active;
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
         * Sets order
         *
         * @param int $order
         */
        public function set_order($order) {
            $this->order = $order;
        }

        /**
         * Gets order
         *
         * @return int
         */
        public function get_order() {
            return $this->order;
        }

        /**
         * Sets answers
         *
         * @param int $answers
         */
        public function set_answers(ArrayCollection  $answers) {
            $this->answers = $answers;
        }

        /**
         * Gets answers
         *
         * @return int
         */
        public function get_answers() {
            return $this->answers;
        }

        /**
         * Adds answer to question
         *
         * @param Damarion\Answer $answer
         * @return  boolean
         */
        public function add_answer(Answer $answer) {

            if (count($this->get_answers()) < 4) {

                $this->answers[] = $answer;

                return true;

            } else {
                return false;
            }

        }

        /**
         * Deletes answer from question
         *
         * @param  Damarion\Answer $answer
         * @return boolean
         */
        public function delete_answer(Answer $answer) {

            $answers = $this->get_answers();

            if (!empty($answers)) {

                foreach ($answers AS $key => $value) {

                    if ($value->get_id() == $answer->get_id()) {

                        unset($this->answers[$key]);
                        return true;

                    } else {
                        return false;
                    }

                }

            } else {
                return false;
            }

        }

        /**
         * Sets game
         *
         * @param int $game
         */
        public function set_game($game) {
            $this->game = $game;
        }

        /**
         * Gets game
         *
         * @return int
         */
        public function get_game() {
            return $this->game;
        }

        // FORM GETTERS AND SETTERS

        /**
         * Sets Id
         *
         * @param int $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * Returns $id
         *
         * @return int
         */
        public function getId() {
            return $this->id;
        }

        /**
         * Sets Game id
         *
         * @param int $game_id
         */
        public function setGameId($game_id) {
            $this->game_id = $game_id;
        }

        /**
         * Gets Game id
         *
         * @return int
         */
        public function getGameId() {
            return $this->game_id;
        }

        /**
         * Sets active parameter
         *
         * @param boolean $active
         */
        public function setActive($active) {
            $this->active = $active;
        }

        /**
         * Gets active parameter
         *
         * @return bool
         */
        public function getActive() {
            return $this->active;
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
         * Sets order
         *
         * @param int $order
         */
        public function setOrder($order) {
            $this->order = $order;
        }

        /**
         * Gets order
         *
         * @return int
         */
        public function getOrder() {
            return $this->order;
        }

        /**
         * Sets answers
         *
         * @param int $answers
         */
        public function setAnswers(ArrayCollection  $answers) {
            $this->answers = $answers;
        }

        /**
         * Gets answers
         *
         * @return int
         */
        public function getAnswers() {
            return $this->answers;
        }

    }
