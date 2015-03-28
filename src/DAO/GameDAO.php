<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\Game;

    class GameDAO {

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
         * Return a list of all games, sorted by date (most recent first).
         *
         * @return array A list of all games.
         */
        public function find_all() {

            $sql = 'SELECT * FROM game ORDER BY game_id ASC';
            $result = $this->db->fetchAll($sql);

            // Convert query result to an array of domain objects

            $games = array();

            foreach ($result as $row) {
                $game_id = $row['game_id'];
                $games[$game_id] = $this->build_game($row);
            }

            return $games;

        }

        /**
         * Creates an Game object based on a DB row.
         *
         * @param array $row The DB row containing Game data.
         * @return \MicroCMS\Domain\Game
         */
        private function build_game(array $row) {

            $game = new Game();

            $game->set_id($row['game_id']);
            $game->set_title($row['game_title']);

            return $game;

        }

    }
