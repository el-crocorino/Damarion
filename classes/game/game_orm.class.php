<?php

    class game_orm extends storable {

        /**
         * game id
         * @var int
         */
        protected $id = 0;

        /**
         * game title
         * @var string
         */
        protected $title = '';

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
