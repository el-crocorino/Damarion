<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Vote;

    class VoteDAO extends DAO {

        /**
         * @var \Damarion\DAO\QuestionDAO
         */
        private $question_DAO;

        /**
         * @var \Damarion\DAO\QuestionDAO
         */
        private $user_DAO;

        /**
         * Sets question DAO
         *
         * @param QuestionDAO $question_DAO
         */
        public function set_question_DAO(QuestionDAO $question_DAO) {
            $this->question_DAO = $question_DAO;
        }
        /**
         * Sets user DAO
         *
         * @param USERDAO $user_DAO
         */
        public function set_user_DAO(UserDAO $user_DAO) {
            $this->user_DAO = $user_DAO;
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
         * @return \Damarion\Domain\Vote
         */
        protected function build_domain_object(array $row) {

            $vote = new Vote();

            $vote->set_id($row['vote_id']);
            $vote->set_user_id($row['vote_user_id']);
            $vote->set_answer_id($row['vote_answer_id']);

            if (array_key_exists('vote_question_id', $row)) {

                // find and set corresponding question

                $vote->set_question_id($row['vote_question_id']);
                $vote->set_question($this->question_DAO->find($row['vote_question_id']));

            }

            if (array_key_exists('vote_user_id', $row)) {

                // Find and set the associated author

                $user_id = $row['vote_user_id'];
                $user = $this->user_DAO->find($user_id);

                $vote->set_user_id($row['vote_user_id']);
                $vote->set_user($user);

            }

            return $vote;

        }

    }
