<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Vote;

    class VoteDAO {

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
         * Return a list of all votes, sorted by date (most recent first).
         *
         * @return array A list of all votes.
         */
        public function find_all() {

            $sql = 'SELECT * FROM vote ORDER BY vote_id ASC';
            $result = $this->db->fetchAll($sql);

            // Convert query result to an array of domain objects

            $votes = array();

            foreach ($result as $row) {
                $vote_id = $row['vote_id'];
                $votes[$vote_id] = $this->build_vote($row);
            }

            return $votes;

        }

        /**
         * Creates an Vote object based on a DB row.
         *
         * @param array $row The DB row containing Vote data.
         * @return \MicroCMS\Domain\Vote
         */
        private function build_vote(array $row) {

            $vote = new Vote();

            $vote->set_id($row['vote_id']);
            $vote->set_user_id($row['vote_user_id']);
            $vote->set_question_id($row['vote_question_id']);
            $vote->set_answer_id($row['vote_answer_id']);

            return $vote;

        }

    }
