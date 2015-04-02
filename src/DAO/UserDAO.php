<?php

    namespace Damarion\DAO;

    #use Doctrine\DBAL\Connection;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;
    use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
    use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
    use Damarion\Domain\User;

    class UserDAO extends DAO implements UserProviderInterface {

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
                $users[] = $this->buildDomainObject($row);
            }

            return $users;

        }

        /**
         * Returns a user matching the supplied id.
         *
         * @param integer $id The user id.
         *
         * @return \Damarion\Domain\User|throws an exception if no matching user is found
         */
        public function find($id) {

            $sql = "select * from user where user_id=?";
            $row = $this->get_db()->fetchAssoc($sql, array($id));

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new \Exception("No user matching id " . $id);
            }

        }

        /**
         * {@inheritDoc}
         */
        public function loadUserByUsername($username) {
            $sql = "select * from user where user_username=?";
            $row = $this->get_db()->fetchAssoc($sql, array($username));

            if ($row) {
                return $this->buildDomainObject($row);
            } else {
                throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
            }

        }

        /**
         * {@inheritDoc}
         */
        public function refreshUser(UserInterface $user) {

            $class = get_class($user);

            if (!$this->supportsClass($class)) {
                throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
            }

            return $this->loadUserByUsername($user->getUsername());

        }

        /**
         * {@inheritDoc}
         */
        public function supportsClass($class) {
            return 'Damarion\Domain\User' === $class;
        }

        /**
         * Creates an User object based on a DB row.
         *
         * @param array $row The DB row containing User data.
         * @return \Damarion\Domain\User
         */
        protected function buildDomainObject(array $row) {

            $user = new User();

            $user->set_id($row['user_id']);
            $user->set_username($row['user_username']);
            $user->set_password($row['user_password']);
            $user->set_salt($row['user_salt']);
            $user->set_role($row['user_role']);

            return $user;

        }

        /**
         * Saves a user into the database.
         *
         * @param \Damarion\Domain\User $user The user to save
         */
        public function save(User $user) {

            $userData = array(
                'user_username' => $user->get_username(),
                'user_salt' => $user->get_salt(),
                'user_password' => $user->get_password(),
                'user_role' => $user->get_role()
            );

            if ($user->get_id()) {

                // The user has already been saved : update it

                $this->get_db()->update('user', $userData, array('user_id' => $user->get_id()));

            } else {

                // The user has never been saved : insert it

                $this->get_db()->insert('user', $userData);

                // Get the id of the newly created user and set it on the entity.

                $id = $this->get_db()->lastInsertId();
                $user->set_id($id);

            }

        }

        /**
         * Removes a user from the database.
         *
         * @param @param integer $id The user id.
         */
        public function delete($id) {

            // Delete the user

            $this->get_db()->delete('user', array('user_id' => $id));

        }

    }
