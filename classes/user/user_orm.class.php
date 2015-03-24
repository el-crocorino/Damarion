<?php

    class user_orm implements storable {

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
         * Sets user password
         *
         * @param string $password
         * @return void
         */
        public function set_password($password) {
            check_string($password, 'password');
            $this->password = $password;
        }

        /**
         * Gets user password
         *
         * @return string
         */
        public function get_password() {
            return $this->password;
        }


        public function load($id, $db) {

            check_int($id, 'id');

            $user_data = $db->get_value('user', $id);

            $this->set_id($user_data['id']);
            $this->set_username($user_data['username']);
            $this->set_password($user_data['password']);

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
        public function get_storable_Order() {

        }

    }
