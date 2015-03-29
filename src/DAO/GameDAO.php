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
