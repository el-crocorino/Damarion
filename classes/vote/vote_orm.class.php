<?php

    class vote_orm extends storable {

        /**
         * vote id
         * @var int
         */
        protected $id = 0;

        /**
         * vote user_id
         * @var int
         */
        protected $user_id = 0;

        /**
         * vote question_id
         * @var string
         */
        protected $question_id = 0;

        /**
         * vote answer_id
         * @var int
         */
        protected $answer_id = 0;

        /**
         *  Gets Object Table
         *
         * @return string Table
         */
        public function get_storable_table() {
            return 'vote';
        }

        /**
         *  Gets object fields
         *
         * @return string Fields
         */
        public function get_storable_fields() {
            return 'vote_id, vote_user_id, vote_question_id, vote_answer_id';
        }

        /**
         *  Gets object values
         *
         * @return string Values
         */
        public function get_storable_values() {

            $values = array(
                ':vote_id' => $this->get_id(),
                ':vote_user_id' => $this->get_user_id(),
                ':vote_question_id' => $this->get_question_id(),
                ':vote_answer_id' => $this->get_answer_id()
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
        public function get_storable_answer_id() {

        }

        /**
         * Converts db results to right type
         *
         * @param array $data Db data
         * @return array
         */
        public static function handle_db_data($data) {

            $data['id'] = (int)$data['id'];
            $data['user_id'] = (int)$data['user_id'];
            $data['question_id'] = (int)$data['question_id'];
            $data['answer_id'] = (int)$data['answer_id'];

            return $data;

        }

    }
