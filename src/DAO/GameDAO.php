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
                $games[$game_id] = $this->buildDomainObject($row);
            }

            return $games;

        }

        /**
         * Returns a game matching the supplied id.
         *
         * @param integer $id
         * @return \Damarion\Domain\Game|throws an exception if no matching game is found
         */
        public function find($id) {

            $sql = "select * from game where game_id=?";
            $row = $this->get_db()->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No game matching id " . $id);
            }

        }

        /**
         * Creates a Game object based on a DB row.
         *
         * @param array $row The DB row containing Game data.
         * @return \Damarion\Domain\Game
         */
        protected function buildDomainObject(array $row) {

            $game = new Game();

            $game->set_id($row['game_id']);
            $game->set_title($row['game_title']);

            return $game;

        }

        /**
         * Saves a game into the database.
         *
         * @param \Damarion\Domain\Game $game The game to save
         */
        public function save(Game $game) {

            $game_data = array(
                'game_title' => $game->get_title()
                );

            if ($game->get_id()) {

                // The game has already been saved : update it

                $this->get_db()->update('game', $game_data, array('game_id' => $game->get_id()));

            } else {

                // The game has never been saved : insert it

                $this->get_db()->insert('game', $game_data);
                // Get the id of the newly created game and set it on the entity.

                $id = $this->get_db()->lastInsertId();
                $game->setId($id);
            }

        }

        /**
         * Removes a game from the database.
         *
         * @param integer $id The game id.
         */
        public function delete($id) {

            // Delete the game

            $this->get_db()->delete('game', array('game_id' => $id));

        }


    }
