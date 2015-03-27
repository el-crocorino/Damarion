<?php

    class question_orm extends storable {

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

        /**
         * Converts db results to right type
         *
         * @param array $data Db data
         * @return array
         */
        public static function handle_db_data($data) {

            $data['id'] = (int)$data['id'];
            $data['game_id'] = (int)$data['game_id'];
            $data['order'] = (int)$data['order'];

            return $data;

        }

    }
