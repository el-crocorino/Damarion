<?php

    namespace Damarion\DAO;

    use Doctrine\DBAL\Connection;
    use Damarion\Domain\User;

    class UserDAO extends DAO {

        /**
         * Return a list of all users, sorted by date (most recent first).
         *
         * @return array A list of all users.
         */
        public function find_all() {

            $sql = 'SELECT * FROM user ORDER BY user_id ASC';
            $result = $this->get_db()->fetchAll($sql);

            // Convert query result to an array of domain objects

            $users = array();

            foreach ($result as $row) {
                $users[] = $this->build_domain_object($row);
            }

            return $users;

        }

        /**
         * Creates an User object based on a DB row.
         *
         * @param array $row The DB row containing User data.
         * @return \MicroCMS\Domain\User
         */
        protected function build_domain_object(array $row) {

            $user = new User();

            $user->set_id($row['user_id']);
            $user->set_username($row['user_username']);

            return $user;

        }

    }
