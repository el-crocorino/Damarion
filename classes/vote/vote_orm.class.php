<?php

    class vote_orm extends storable {

        /**
         * Table prefix length description
         *
         * @var int
         */
        protected $table_prefix_length = NULL;

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

        public function __construct() {
            $this->table_prefix_length = strlen(substr(__CLASS__, 0, -4)) + 1;
        }

        /**
         * Sets vote id
         *
         * @return string
         */
        public function set_id($id) {
            $this->id = (int)$id;
        }

        /**
         * Gets vote id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets vote user_id
         *
         * @return string
         */
        public function set_user_id($user_id) {
            $this->user_id = (int)$user_id;
        }

        /**
         * Gets vote user_id
         *
         * @return string
         */
        public function get_user_id() {
            return $this->user_id;
        }

        /**
         * Sets vote question id
         *
         * @param string $question_id
         * @return void
         */
        public function set_question_id($question_id) {
            $this->question_id = (int)$question_id;
        }

        /**
         * Gets vote question id
         *
         * @return string
         */
        public function get_question_id() {
            return $this->question_id;
        }

        /**
         * Sets vote answer id
         *
         * @return string
         */
        public function set_answer_id($answer_id) {
            $this->answer_id = (int)$answer_id;
        }

        /**
         * Gets vote answer_id
         *
         * @return string
         */
        public function get_answer_id() {
            return $this->answer_id;
        }

        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $vote_data = $db->get_value('vote', $id);

            foreach ($vote_data AS $index => $item) {

                if (false !== strpos($index, '_id') || false !== strpos($index, '_answer_id')) {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function load_by_property(string $field, $value = NULL) {

            /*check_int($field);

            if is_string($value) {
                $value = '"' . $value . '"';
            }

            $this->set_id($vote_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($vote_id) {

            check_int($vote_id, 'vote_id');

            $this->set_id($vote_id);

            $where = array('vote_id = ' . $vote_id);

            $db = dbmanager::get_slave();
            $vote_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($vote_data AS $index => $item) {

                if ($index == 'vote_id') {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*vote with id already exists*/false) {
                $db->update($this);
            } else {
                $db->save($this);
            }


        }

        /**
         *  Gets Object Table
         *
         * @return string Table
         */
        public function get_storable_table() {
            return 'vote';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'vote_id, vote_user_id, vote_question_id, vote_answer_id';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':vote_id' => $this->get_id(),
                ':vote_user_id' => $this->get_user_id(),
                ':vote_question_id' => $this->get_question_id(),
                ':vote_answer_id' => $this->get_answer_id()
            );

            return $values;

        }

        /**
         *  Gets Where condition
         *
         * @return array Where
         */
        public function get_storable_where() {

        }

        /**
         *  Gets Group By condition
         *
         * @return array Group
         */
        public function get_storable_group() {

        }

        /**
         *  Gets Order By condition
         *
         * @return array Order
         */
        public function get_storable_answer_id() {

        }

    }
