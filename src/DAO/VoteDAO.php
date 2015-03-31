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
         * @var \Damarion\DAO\UserDAO
         */
        private $user_DAO;

        /**
         * @var \Damarion\DAO\AnswerDAO
         */
        private $answer_DAO;

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
         * Sets answer DAO
         *
         * @param USERDAO $answer_DAO
         */
        public function set_answer_DAO(AnswerDAO $answer_DAO) {
            $this->answer_DAO = $answer_DAO;
        }

        /**
         * Return a list of all votes, sorted by date (most recent first).
         *
         * @return array A list of all votes.
         */
        public function find_all() {

            $sql = 'SELECT * FROM vote ORDER BY vote_question_id, vote_user_id ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {
                $vote_id = $row['vote_id'];
                $votes[$vote_id] = $this->buildDomainObject($row);
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

            $sql = "SELECT vote_id, vote_user_id, vote_answer_id FROM vote WHERE vote_question_id=? ORDER BY vote_id";
            $result = $this->get_db()->fetchAll($sql, array($question_id));

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {

                $vote = $this->buildDomainObject($row);

                // The associated question is defined for the constructed vote

                $vote->set_question_id($question->get_id());
                $vote->set_question($question);
                $votes[] = $vote;

            }

            return $votes;

        }

        /**
         * Return a list of all votes for a question / user tuple
         *
         * @param integer $question_id The question id.
         * @param integer $user_id The user id.
         *
         * @return array A list of all votes for the question.
         */
        public function find_all_by_question_and_user($question_id, $user_id) {

            // The associated question is retrieved only once

            $question = $this->question_DAO->find($question_id);

            $sql = "SELECT vote_id, vote_user_id, vote_answer_id FROM vote WHERE vote_question_id=? AND vote_user_id=? ORDER BY vote_id";
            $result = $this->get_db()->fetchAll($sql, array($question_id, $user_id));

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {

                $vote = $this->buildDomainObject($row);

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
        protected function buildDomainObject(array $row) {

            $vote = new Vote();

            $vote->set_id($row['vote_id']);

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

            if (array_key_exists('vote_answer_id', $row)) {

                // Find and set the associated author

                $answer_id = $row['vote_answer_id'];
                $answer = $this->answer_DAO->find($answer_id);

                $vote->set_answer_id($row['vote_answer_id']);
                $vote->set_answer($answer);

            }

            return $vote;

        }

        /**
         * Saves a vote into the database.
         *
         * @param \Damrion\Domain\Comment $vote The vote to save
         */
        public function save(Vote $vote) {

            $voteData = array(
                'vote_question_id' => $vote->get_question()->get_id(),
                'vote_user_id' => $vote->get_user()->get_id(),
                'vote_answer_id' => $vote->get_answer_id()
                );

            $user_vote = $this->find_all_by_question_and_user($vote->get_question()->get_id(), $vote->get_user()->get_id());

            if (count($user_vote) > 0) {
                return false;
            } else {

                // The vote has never been saved : insert it

                $this->get_db()->insert('vote', $voteData);

                // Get the id of the newly created vote and set it on the entity.

                $id = $this->get_db()->lastInsertId();
                $vote->set_id($id);

                return true;

            }

        }

    }
