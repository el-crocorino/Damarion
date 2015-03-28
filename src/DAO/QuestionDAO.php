<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Question;

    class QuestionDAO {

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
         * Return a list of all questions, sorted by date (most recent first).
         *
         * @return array A list of all questions.
         */
        public function find_all() {

            $sql = 'SELECT * FROM question ORDER BY question_order ASC';
            $result = $this->db->fetchAll($sql);

            // Convert query result to an array of domain objects

            $questions = array();

            foreach ($result as $row) {
                $question_order = $row['question_order'];
                $questions[$question_order] = $this->build_question($row);
            }

            return $questions;

        }

        /**
         * Return a list of all questions, sorted by date (most recent first).
         *
         * @return array A list of all questions.
         */
        public function find_current() {

            $sql = 'SELECT * FROM question WHERE question_active = 1';
            $result = $this->db->fetchAssoc($sql);

            return $this->build_question($result);

        }

        /**
         * Creates an Question object based on a DB row.
         *
         * @param array $row The DB row containing Question data.
         * @return \MicroCMS\Domain\Question
         */
        private function build_question(array $row) {

            $question = new Question();

            $question->set_id($row['question_id']);
            $question->set_game_id($row['question_game_id']);
            $question->set_active($row['question_active']);
            $question->set_text($row['question_text']);
            $question->set_order($row['question_order']);

            return $question;

        }

    }
