<?php

    class user_orm extends storable {

        /**
         * User id
         * @var int
         */
        protected $id = 0;

        /**
         * User username
         * @var string
         */
        protected $username = '';

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
            return 'user_id, user_username';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':user_id' => $this->get_id(),
                ':user_username' => $this->get_username()
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

        /**
         * Converts db results to right type
         *
         * @param array $data Db data
         * @return array
         */
        public static function handle_db_data($data) {

            $data['id'] = (int)$data['id'];

            return $data;

        }

    }
