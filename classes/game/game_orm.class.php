<?php

    class game_orm extends storable {

        /**
         * Table prefix length description
         *
         * @var int
         */
        protected $table_prefix_length = NULL;

        /**
         * game id
         * @var int
         */
        protected $id = NULL;

        /**
         * game title
         * @var string
         */
        protected $title = '';

        public function __construct() {
            $this->table_prefix_length = strlen(substr(__CLASS__, 0, -4)) + 1;
        }

        /**
         * Sets game id
         *
         * @return string
         */
        public function set_id($id) {

            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets game id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets game title
         *
         * @param string $title
         * @return void
         */
        public function set_title($title) {
            check_string($title, 'title');
            $this->title = $title;
        }

        /**
         * Gets game title
         *
         * @return string
         */
        public function get_title() {
            return $this->title;
        }

        /**
         * Loads game from db with id
         *
         * @param int $id Game id
         * @return void
         */
        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $game_data = $db->get_value('game', $id);

            foreach ($game_data AS $index => $item) {

                if (false !== strpos($index, '_id')) {
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

            $this->set_id($game_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($game_id) {

            check_int($game_id, 'game_id');

            $this->set_id($game_id);

            $where = array('game_id = ' . $game_id);

            $db = dbmanager::get_slave();
            $game_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($game_data AS $index => $item) {

                if (false !== strpos($index, '_id')) {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, $this->table_prefix_length);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*game with id already exists*/false) {
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
            return 'game';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'game_id, game_title';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':game_id' => $this->get_id(),
                ':game_title' => $this->get_title()
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
