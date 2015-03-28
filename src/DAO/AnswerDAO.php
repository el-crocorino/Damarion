<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Answer;

    class AnswerDAO extends DAO {

        /**
         * @var \MicroCMS\DAO\QuestionDAO
         */
        private $question_DAO;

        public function set_question_DAO(QuestionDAO $question_DAO) {
            $this->question_DAO = $question_DAO;
        }

        /**
         * Return a list of all answers, sorted by date (most recent first).
         *
         * @return array A list of all answers.
         */
        public function find_all() {

            $sql = 'SELECT * FROM answer ORDER BY answer_question_id, answer_id ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {
                $answer_id = $row['answer_id'];
                $answers[$answer_id] = $this->build_domain_object($row);
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

            if ($active) {
                $sql .= ' AND answer_active = 1';
            }

            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {
                $answers[] = $this->build_domain_object($row);
            }

            return $answers;

        }

        /**
         * Return a list of all answers for a question
         *
         * @param integer $question_id The question id.
         *
         * @return array A list of all answers for the question.
         */
        public function find_all_by_question($question_id) {

            // The associated question is retrieved only once

            $question = $this->question_DAO->find($question_id);

            $sql = "select answer_id, answer_text, answer_right, answer_active from answer where answer_question_id=? order by answer_id";
            $result = $this->get_db()->fetchAll($sql, array($question_id));

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {

                $answer = $this->build_domain_object($row);

                // The associated question is defined for the constructed answer

                $answer->set_question_id($question->get_id());
                $answer->set_question($question);
                $answers[] = $answer;

            }

            return $answers;

        }

        /**
         * Creates an Answer object based on a DB row.
         *
         * @param array $row The DB row containing Answer data.
         * @return \MicroCMS\Domain\Answer
         */
        protected function build_domain_object(array $row) {

            $answer = new Answer();

            $answer->set_id($row['answer_id']);
            $answer->set_text($row['answer_text']);
            $answer->set_right($row['answer_right']);
            $answer->set_active($row['answer_active']);

            if (array_key_exists('answer_question_id', $row)) {

                // find and set corresponding question

                $answer->set_question_id($row['answer_question_id']);
                $answer->set_question($this->question_DAO->find($row['answer_question_id']));

            }

            return $answer;

        }

    }
