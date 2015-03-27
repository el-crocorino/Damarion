<?php

    class answer_orm extends storable {

        /**
         * answer id
         *
         * @var int
         */
        protected $id = 0;

        /**
         * answer question_id
         *
         * @var int
         */
        protected $question_id = 0;

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
        protected $right = false;

        /**
         * answer active
         *
         * @var bool
         */
        protected $active = true;

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
                ':answer_question_id' => $this->get_question_id(),
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

        /**
         * Converts db results to right type
         *
         * @param array $data Db data
         * @return array
         */
        public static function handle_db_data($data) {

            $data['id'] = (int)$data['id'];
            $data['question_id'] = (int)$data['question_id'];
            $data['right'] = (boolean)$data['right'];
            $data['active'] = (boolean)$data['active'];

            return $data;

        }

    }
