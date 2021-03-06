<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Answer;

    class AnswerDAO extends DAO {

        /**
         * @var \Damarion\DAO\QuestionDAO
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
                $answers[$answer_id] = $this->buildDomainObject($row);
            }

            return $answers;

        }

        /**
         * Returns a answer matching the supplied id.
         *
         * @param integer $id The answer id.
         *
         * @return \Damarion\Domain\User|throws an exception if no matching answer is found
         */
        public function find($id) {

            $sql = "select * from answer where answer_id=?";
            $row = $this->get_db()->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No answer matching id " . $id);
            }

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
                $answers[] = $this->buildDomainObject($row);
            }

            return $answers;

        }

        /**
         * Return a list of all answers, sorted by date (most recent first).
         *
         * @return array A list of all answers.
         */
        public function find_inactive_answers($question_id) {

            $sql = 'SELECT * FROM answer WHERE answer_question_id = ' . $question_id . ' AND answer_active = 0';

            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $answers = array();

            foreach ($result as $row) {
                $answers[] = $this->buildDomainObject($row);
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

                $answer = $this->buildDomainObject($row);

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
         * @return \Damarion\Domain\Answer
         */
        protected function buildDomainObject(array $row) {

            $answer = new Answer();

            $answer->set_id($row['answer_id']);
            $answer->set_text($row['answer_text']);

            $answer->set_active(false);
            $answer->set_right(false);

            if ($row['answer_active'] > 0) {
                $answer->set_active(true);
            }

            if ($row['answer_right'] > 0) {
                $answer->set_right(true);
            }

            if (array_key_exists('answer_question_id', $row)) {

                // find and set corresponding question

                $answer->set_question_id($row['answer_question_id']);
                $answer->set_question($this->question_DAO->find($row['answer_question_id']));

            }

            return $answer;

        }

        /**
         * Saves an answer into the database.
         *
         * @param \Damarion\Domain\Answer $answer The answer to save
         */
        public function save(Answer $answer) {

            $answer_data = array(
                'answer_question_id' => $answer->get_question_id(),
                'answer_text' => $answer->get_text(),
                'answer_right' => $answer->get_right(),
                'answer_active' => $answer->get_active()
                );

            if ($answer->get_id()) {

                // The answer has already been saved : update it

                $this->get_db()->update('answer', $answer_data, array('answer_id' => $answer->get_id()));

            } else {

                // The answer has never been saved : insert it

                $this->get_db()->insert('answer', $answer_data);

                // Get the id of the newly created answer and set it on the entity.

                $id = $this->get_db()->lastInsertId();
                $answer->set_id($id);
            }

        }

        /**
         * Removes a answer from the database.
         *
         * @param integer $id The answer id.
         */
        public function delete($id) {

            // Delete the answer

            $this->get_db()->delete('answer', array('answer_id' => $id));

        }

        /**
         * Removes all answers for a question
         *
         * @param integer $questionId The id of the question
         */
        public function delete_all_by_question($questionId) {
            $this->get_db()->delete('answer', array('answer_question_id' => $questionId));
        }

    }
