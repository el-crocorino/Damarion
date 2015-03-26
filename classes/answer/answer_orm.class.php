<?php

    class answer_orm extends storable {

        /**
         * Table prefix length description
         *
         * @var int
         */
        protected $table_prefix_length = NULL;

        /**
         * answer id
         *
         * @var int
         */
        protected $id = NULL;

        /**
         * answer game_id
         *
         * @var int
         */
        protected $question_id = NULL;

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
        protected $right = NULL;

        /**
         * answer active
         *
         * @var bool
         */
        protected $active = NULL;

        public function __construct() {
            $this->table_prefix_length = strlen(substr(__CLASS__, 0, -4)) + 1;
        }

        /**
         * Sets answer id
         *
         * @return string
         */
        public function set_id($id) {
            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets answer id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets answer game_id
         *
         * @return string
         */
        public function set_question_id($question_id) {
            check_int($question_id, 'question_id');
            $this->question_id = $question_id;
        }

        /**
         * Gets answer question_id
         *
         * @return string
         */
        public function get_question_id() {
            return $this->question_id;
        }

        /**
         * Sets answer text
         *
         * @param string $text
         * @return void
         */
        public function set_text($text) {
            check_string($text, 'text');
            $this->text = $text;
        }

        /**
         * Gets answer text
         *
         * @return string
         */
        public function get_text() {
            return $this->text;
        }

        /**
         * Sets answer right
         *
         * @return string
         */
        public function set_right($right) {
            check_bool($right, 'right');
            $this->right = $right;
        }

        /**
         * Gets answer right
         *
         * @return string
         */
        public function get_right() {
            return $this->right;
        }

        /**
         * Sets answer active
         *
         * @return string
         */
        public function set_active($active) {
            check_bool($active, 'active');
            $this->active = $active;
        }

        /**
         * Gets answer active
         *
         * @return string
         */
        public function get_active() {
            return $this->active;
        }

        /**
         * Loads answer from db with id
         *
         * @param int $id Answer id
         * @return void
         */
        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $answer_data = $db->get_value('answer', $id);

            foreach ($answer_data AS $index => $item) {

                if (false !== strpos($index, '_id') || false !== strpos($index, '_order')) {
                    $item = (int)$item;
                }

                if (false !== strpos($index, '_right') || false !== strpos($index, '_active')) {
                    $item = (boolean)$item;
                }

                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function load_by_property(string $field, $value = NULL) {

            /*check_string($field);

            if is_string($value) {
                $value = '"' . $value . '"';
            }

            $this->set_id($answer_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($answer_id) {

            check_int($answer_id, 'answer_id');

            $this->set_id($answer_id);

            $where = array('answer_id = ' . $answer_id);

            $db = dbmanager::get_slave();

            $answer_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($answer_data AS $index => $item) {

                if (false !== strpos($index, '_id') || false !== strpos($index, '_order')) {
                    $item = (int)$item;
                }

                if (false !== strpos($index, '_right') || false !== strpos($index, '_active')) {
                    $item = (boolean)$item;
                }


                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*answer with id already exists*/false) {
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
            return 'answer';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'answer_id, answer_question_id, answer_text, answer_right, answer_active';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':answer_id' => $this->get_id(),
                ':answer_answer_id' => $this->get_game_id(),
                ':answer_text' => $this->get_text(),
                ':answer_right' => $this->get_right(),
                ':answer_active' => $this->get_active()
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
        public function get_storable_order() {

        }

    }
