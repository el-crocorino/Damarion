<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Game;

    class GameDAO extends DAO {

        /**
         * Return a list of all games, sorted by date (most recent first).
         *
         * @return array A list of all games.
         */
        public function find_all() {

            $sql = 'SELECT * FROM game ORDER BY game_id ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $games = array();

            foreach ($result as $row) {
                $game_id = $row['game_id'];
                $games[$game_id] = $this->build_domain_object($row);
            }

            return $games;

        }

        /**
         * Returns a game matching the supplied id.
         *
         * @param integer $id
         * @return \MicroCMS\Domain\Article|throws an exception if no matching game is found
         */
        public function find($id) {

            $sql = "select * from game where game_id=?";
            $row = $this->getDb()->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->build_domain_object($row);
            } else {
                throw new \Exception("No game matching id " . $id);
            }

        }

        /**
         * Creates an Game object based on a DB row.
         *
         * @param array $row The DB row containing Game data.
         * @return \Damarion\Domain\Game
         */
        protected function build_domain_object(array $row) {

            $game = new Game();

            $game->set_id($row['game_id']);
            $game->set_title($row['game_title']);

            return $game;

        }

    }
