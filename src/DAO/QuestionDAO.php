<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Question;

    class QuestionDAO extends DAO {

        /**
         * Return a list of all questions, sorted by date (most recent first).
         *
         * @return array A list of all questions.
         */
        public function find_all() {

            $sql = 'SELECT * FROM question ORDER BY question_order ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $questions = array();

            foreach ($result as $row) {
                $question_order = $row['question_order'];
                $questions[$question_order] = $this->build_domain_object($row);
            }

            return $questions;

        }

        /**
         * Returns a question matching the supplied id.
         *
         * @param integer $id
         *
         * @return \Damarion\Domain\Question|throws an exception if no matching question is found
         */
        public function find($id) {

            $sql = 'SELECT * FROM question WHERE question_id=?';
            $row = $this->get_db()->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->build_domain_object($row);
            } else {
                throw new \Exception("No question matching id " . $id);
            }

        }

        /**
         * Return a list of all questions, sorted by date (most recent first).
         *
         * @return array A list of all questions.
         */
        public function find_current() {

            $sql = 'SELECT * FROM question WHERE question_active = 1';
            $result = $this->get_db()->fetchAssoc($sql);

            if ($row) {
                return $this->build_domain_object($row);
            } else {
                throw new \Exception("No question matching id " . $id);
            }

        }

        /**
         * Return an array of votes stats for given question id.
         *
         * @param int $question_id
         * @return array A list of all questions.
         */
        public function get_stats_by_question($question_id) {

            $sql = 'SELECT vote_answer_id, answer_text, vote_question_id, COUNT( vote_user_id ) AS votes FROM vote LEFT JOIN answer ON ( vote_answer_id = answer_id ) WHERE vote_question_id = ' . $question_id . ' GROUP BY vote_answer_id';

            $result = $this->get_db()->fetchAll($sql);

            return $result;

        }

        /**
         * Creates an Question object based on a DB row.
         *
         * @param array $row The DB row containing Question data.
         * @return \Damarion\Domain\Question
         */
        protected function build_domain_object(array $row) {

            $question = new Question();

            $question->set_id($row['question_id']);
            $question->set_game_id($row['question_game_id']);
            $question->set_active($row['question_active']);
            $question->set_text($row['question_text']);
            $question->set_order($row['question_order']);

            return $question;

        }

    }
