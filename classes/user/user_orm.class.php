<?php

    class user_orm extends storable {

        /**
         * Table prefix length description
         *
         * @var int
         */
        protected $table_prefix_length = NULL;

        /**
         * User id
         * @var int
         */
        protected $id = NULL;

        /**
         * User username
         * @var string
         */
        protected $username = '';

        /**
         * User password
         * @var string
         */
        protected $password = '';

        public function __construct() {
            $this->table_prefix_length = strlen(substr(__CLASS__, 0, -4)) + 1;
        }

        /**
         * Sets user id
         *
         * @return string
         */
        public function set_id($id) {
            check_int($id, 'id');
            $this->id = $id;
        }

        /**
         * Gets user id
         *
         * @return string
         */
        public function get_id() {
            return $this->id;
        }

        /**
         * Sets user username
         *
         * @param string $username
         * @return void
         */
        public function set_username($username) {
            check_string($username, 'username');
            $this->username = $username;
        }

        /**
         * Gets user username
         *
         * @return string
         */
        public function get_username() {
            return $this->username;
        }

        /**
         * Loads user from db with id
         *
         * @param int $id Game id
         * @return void
         */
        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $data = $db->get_value('user', $id);

            foreach ($data AS $index => $item) {

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

            $this->set_id($user_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get($user_id) {

            check_int($user_id, 'user_id');
            $this->set_id($user_id);

            $where = array('user_id = ' . $user_id);

            $db = dbmanager::get_slave();
            $user_data = $db->get($this->get_storable_table(), $this->get_storable_fields(), $where, array(), array());

            foreach ($user_data AS $index => $item) {

                if ($index == 'user_id') {
                    $item = (int)$item;
                }

                $method = 'set_' . substr($index, 5);
                $this->$method($item);

            }

        }

        public function save() {

            $db = dbmanager::get_master();

            if (/*user with id already exists*/false) {
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
            return 'user';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'user_id, user_username, user_password';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':user_id' => $this->get_id(),
                ':user_username' => $this->get_username(),
                ':user_password' => $this->get_password()
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
