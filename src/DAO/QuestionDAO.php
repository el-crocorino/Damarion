<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Question;

    class QuestionDAO extends DAO {

        /**
         * @var \MicroCMS\DAO\GameDAO
         */
        private $game_DAO;

        public function set_game_DAO(GameDAO $game_DAO) {
            $this->game_DAO = $game_DAO;
        }

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
                $questions[$question_order] = $this->buildDomainObject($row);
            }

            return $questions;

        }

        /**
         * Return a list of all questions for a game, sorted by id.
         *
         * @param integer $game_id The game id.
         * @return array A list of all questions for the game.
         */
        public function find_all_by_game($game_id) {

            // The associated game is retrieved only once
            $game = $this->gameDAO->find($game_id);

            // art_id is not selected by the SQL query
            // The game won't be retrieved during domain objet construction

            $sql = "select question_id, question_active, question_text, question_order from question where game_id=? order by question_id";
            $result = $this->get_db()->fetchAll($sql, array($game_id));

            // Convert query result to an array of domain objects

            $questions = array();

            foreach ($result as $row) {

                $question_order = $row['question_order'];
                $question = $this->buildDomainObject($row);

                // The associated game is defined for the constructed question

                $question->setArticle($game);
                $questions[$question_order] = $question;

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
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No question matching id " . $id);
            }

        }

        /**
         * Returns a question matching the supplied order.
         *
         * @param integer $order
         *
         * @return \Damarion\Domain\Question|throws an exception if no matching question is found
         */
        public function find_by_order($order) {

            $sql = 'SELECT * FROM question WHERE question_order=?';
            $row = $this->get_db()->fetchAssoc($sql, array($order));

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No question matching order " . $order);
            }

        }

        /**
         * Return a list of all questions, sorted by date (most recent first).
         *
         * @return array A list of all questions.
         */
        public function find_current() {

            $sql = 'SELECT * FROM question WHERE question_active = 1';
            $row = $this->get_db()->fetchAssoc($sql);

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No question matching id " . $id);
            }

        }


        /**
         * Return a id of right answer.
         *
         * @return array A list of all questions.
         */
        public function get_right_answer($question_id) {

            $sql = 'SELECT answer_id FROM answer WHERE answer_question_id = ' . $question_id . ' and answer_right = 1';
            $row = $this->get_db()->fetchAssoc($sql);

            if ($row) {
                return $row['answer_id'];
            } else {
                throw new \Exception("No right answer for queston with id " . $id);
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
         * Removes all questions for a game
         *
         * @param $game_id The id of the game
         */
        public function delete_all_by_game($game_id) {
            $this->get_db()->delete('question', array('question_game_id' => $game_id));
        }

        /**
         * Creates an Question object based on a DB row.
         *
         * @param array $row The DB row containing Question data.
         * @return \Damarion\Domain\Question
         */
        protected function buildDomainObject(array $row) {

            $question = new Question();

            $question->set_id($row['question_id']);
            $question->set_text($row['question_text']);
            $question->set_order($row['question_order']);

            $question->set_active(false);

            if ($row['question_active'] > 0) {
                $question->set_active(true);
            }


            if (array_key_exists('question_game_id', $row)) {

                // Find and set the associated game

                $game = $this->game_DAO->find($row['question_game_id']);
                $question->set_game_id($row['question_game_id']);
                $question->set_game($game);

            }

            return $question;

        }

        /**
         * Saves a question into the database.
         *
         * @param \Damarion\Domain\Question $question The question to save
         */
        public function save(Question $question) {

            $question_data = array(
                'question_game_id' => $question->get_game_id(),
                'question_text' => $question->get_text(),
                'question_order' => $question->get_order(),
                'question_active' => $question->get_active()
                );

            if ($question->get_id()) {

                // The question has already been saved : update it

                $this->get_db()->update('question', $question_data, array('question_id' => $question->get_id()));

            } else {

                // The question has never been saved : insert it

                $this->get_db()->insert('question', $question_data);
                // Get the id of the newly created question and set it on the entity.

                $id = $this->get_db()->lastInsertId();
                $question->set_id($id);
            }

        }

        /**
         * Removes a question from the database.
         *
         * @param integer $id The question id.
         */
        public function delete($id) {

            // Delete the question

            $this->get_db()->delete('question', array('question_id' => $id));

        }

    }
