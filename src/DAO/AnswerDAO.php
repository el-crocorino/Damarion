<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Answer;

    class AnswerDAO {

        /**
         * Database connection
         *
         * @var \Doctrine\DBAL\Connection
         */
        private $db;

        /**
         * Constructor
         *
         * @param \Doctrine\DBAL\Connection The database connection object
         */
        public function __construct(Connection $db) {
            $this->db = $db;
        }

        /**
         * Return a list of all answers, sorted by date (most recent first).
         *
         * @return array A list of all answers.
         */
        public function find_all() {

            $sql = 'SELECT * FROM answer ORDER BY answer_question_id, answer_id ASC';
            $result = $this->db->fetchAll($sql);

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {
                $answer_id = $row['answer_id'];
                $answers[$answer_id] = $this->build_answer($row);
            }

            return $answers;

        }

        /**
         * Return a list of all answers, sorted by date (most recent first).
         *
         * @return array A list of all answers.
         */
        public function find_current_answer($question_id, $active = false) {

            $sql = 'SELECT * FROM answer WHERE answer_question_id = ' . $question_id;

            if ($active); {
                $sql .= 'AND answer_active = 1';
            }

            $result = $this->db->fetchAll($sql);

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {
                $answers[] = $this->build_answer($row);
            }

            return $answers;

        }

        /**
         * Creates an Answer object based on a DB row.
         *
         * @param array $row The DB row containing Answer data.
         * @return \MicroCMS\Domain\Answer
         */
        private function build_answer(array $row) {

            $answer = new Answer();

            $answer->set_id($row['answer_id']);
            $answer->set_question_id($row['answer_question_id']);
            $answer->set_text($row['answer_text']);
            $answer->set_right($row['answer_right']);
            $answer->set_active($row['answer_active']);

            return $answer;

        }

    }
