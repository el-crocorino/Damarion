<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Vote;

    class VoteDAO extends DAO {

        /**
         * @var \MicroCMS\DAO\QuestionDAO
         */
        private $question_DAO;

        public function set_question_DAO(QuestionDAO $question_DAO) {
            $this->question_DAO = $question_DAO;
        }

        /**
         * Return a list of all votes, sorted by date (most recent first).
         *
         * @return array A list of all votes.
         */
        public function find_all() {

            $sql = 'SELECT * FROM vote ORDER BY vote_id ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {
                $vote_id = $row['vote_id'];
                $votes[$vote_id] = $this->build_domain_object($row);
            }

            return $votes;

        }

        /**
         * Return a list of all votes for a question
         *
         * @param integer $question_id The question id.
         *
         * @return array A list of all votes for the question.
         */
        public function find_all_by_question($question_id) {

            // The associated question is retrieved only once

            $question = $this->question_DAO->find($question_id);

            $sql = "select vote_id, vote_user_id, vote_answer_id from vote where vote_question_id=? order by vote_id";
            $result = $this->get_db()->fetchAll($sql, array($question_id));

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {

                $vote = $this->build_domain_object($row);

                // The associated question is defined for the constructed vote

                $vote->set_question_id($question->get_id());
                $vote->set_question($question);
                $votes[] = $vote;

            }

            return $votes;

        }

        /**
         * Creates an Vote object based on a DB row.
         *
         * @param array $row The DB row containing Vote data.
         * @return \MicroCMS\Domain\Vote
         */
        protected function build_domain_object(array $row) {

            $vote = new Vote();

            $vote->set_id($row['vote_id']);
            $vote->set_user_id($row['vote_user_id']);
            $vote->set_answer_id($row['vote_answer_id']);

            if (array_key_exists('answer_question_id', $row)) {

                // find and set corresponding question

                $answer->set_question_id($row['answer_question_id']);
                $answer->set_question($this->question_DAO->find($row['answer_question_id']));

            }

            return $vote;

        }

    }
