<?php

    class option_orm extends storable {

        /**
         * option id
         * @var int
         */
        protected $id = NULL;

        /**
         * option game_id
         * @var int
         */
        protected $question_id = NULL;

        /**
         * option text
         * @var string
         */
        protected $text = '';

        /**
         * option right
         * @var bool
         */
        protected $right = NULL;

        /**
         * option active
         * @var bool
         */
        protected $active = NULL;

        /**
         * Sets option id
         *
         * @return string
         */
        public function set_id($id) {
            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets option id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets option game_id
         *
         * @return string
         */
        public function set_question_id($question_id) {
            check_int($question_id, 'question_id');
            $this->question_id = $question_id;
        }

        /**
         * Gets option question_id
         *
         * @return string
         */
        public function get_question_id() {
            return $this->question_id;
        }

        /**
         * Sets option text
         *
         * @param string $text
         * @return void
         */
        public function set_text($text) {
            check_string($text, 'text');
            $this->text = $text;
        }

        /**
         * Gets option text
         *
         * @return string
         */
        public function get_text() {
            return $this->text;
        }

        /**
         * Sets option right
         *
         * @return string
         */
        public function set_right($right) {
            check_int($right, 'right');
            $this->right = $right;
        }

        /**
         * Gets option right
         *
         * @return string
         */
        public function get_right() {
            return $this->right;
        }

        /**
         * Sets option active
         *
         * @return string
         */
        public function set_active($active) {
            check_int($active, 'active');
            $this->active = $active;
        }

        /**
         * Gets option active
         *
         * @return string
         */
        public function get_active() {
            return $this->active;
        }

        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $option_data = $db->get_value('option', $id);

            foreach ($option_data AS $index => $item) {

                if (false !== strpos($index, '_id') || false !== strpos($index, '_order')) {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, 9);
                $this->$method($item);

            }

        }

        public function load_by_property(string $field, $value = NULL) {

            /*check_string($field);

            if is_string($value) {
                $value = '"' . $value . '"';
            }

            $this->set_id($option_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($option_id) {

            check_int($option_id, 'option_id');

            $this->set_id($option_id);

            $where = array('option_id = ' . $option_id);

            $db = dbmanager::get_slave();
            $option_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($option_data AS $index => $item) {

                if ($index == 'option_id') {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, 5);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*option with id already exists*/false) {
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
            return 'option';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'option_id, option_question_id, option_text, option_right, option_active';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':option_id' => $this->get_id(),
                ':option_game_id' => $this->get_game_id(),
                ':option_text' => $this->get_text(),
                ':option_right' => $this->get_right(),
                ':option_active' => $this->get_active()
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
