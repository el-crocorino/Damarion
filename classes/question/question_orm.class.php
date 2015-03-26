<?php

    class question_orm extends storable {

        /**
         * Table prefix length description
         *
         * @var int
         */
        protected $table_prefix_length = NULL;

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
         * @var string
         */
        protected $text = '';

        /**
         * question order
         *
         * @var int
         */
        protected $order = 0;

        public function __construct() {
            $this->table_prefix_length = strlen(substr(__CLASS__, 0, -4)) + 1;
        }

        /**
         * Sets question id
         *
         * @return string
         */
        public function set_id($id) {
            $this->id = (int)$id;
        }

        /**
         * Gets question id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets question game_id
         *
         * @return string
         */
        public function set_game_id($game_id) {
            $this->game_id = (int)$game_id;
        }

        /**
         * Gets question game_id
         *
         * @return string
         */
        public function get_game_id() {
            return $this->game_id;
        }

        /**
         * Sets question text
         *
         * @param string $text
         * @return void
         */
        public function set_text($text) {
            $this->text = $text;
        }

        /**
         * Gets question text
         *
         * @return string
         */
        public function get_text() {
            return $this->text;
        }

        /**
         * Sets question order
         *
         * @return int
         */
        public function set_order($order) {
            $this->order = (int)$order;
        }

        /**
         * Gets question order
         *
         * @return int
         */
        public function get_order() {
            return $this->order;
        }

        /**
         * Loads question from db with id
         *
         * @param int $id Question id
         * @return void
         */
        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $question_data = $db->get_value('question', $id);

            foreach ($question_data AS $index => $item) {

                if (false !== strpos($index, '_id') || false !== strpos($index, '_order')) {
                    $item = (int)$item;
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

            $this->set_id($question_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($question_id) {

            check_int($question_id, 'question_id');

            $this->set_id($question_id);

            $where = array('question_id = ' . $question_id);

            $db = dbmanager::get_slave();
            $question_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($question_data AS $index => $item) {

                if ($index == 'question_id') {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*question with id already exists*/false) {
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
            return 'question';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'question_id, question_game_id, question_text, question_order';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':question_id' => $this->get_id(),
                ':question_game_id' => $this->get_game_id(),
                ':question_text' => $this->get_text(),
                ':question_order' => $this->get_order()
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
