<?php

    namespace Damarion\Domain;

    use Symfony\Component\Security\Core\User\UserInterface;

    class User implements UserInterface {

    /**
     * User id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * User username
     *
     * @var string
     */
    protected $username = '';

    /**
     * User password
     *
     * @var string
     */
    protected $password = '';

    /**
     * User salt
     *
     * @var string
     */
    protected $salt = '';

    /**
     * User role
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    protected $role = '';

    /**
     * Sets id
     *
     * @param int $id
     */
    public function set_id($id) {
        $this->id = $id;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Sets username
     *
     * @param int $username
     */
    public function set_username($username) {
        $this->username = $username;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function get_username() {
        return $this->username;
    }

    /**
     * Sets password
     *
     * @param string $password
     */
    public function set_password($password) {
        $this->password = $password;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function get_password() {
        return $this->password;
    }

    /**
     * Sets salt
     *
     * @param string $salt
     */
    public function set_salt($salt) {
        $this->salt = $salt;
    }

    /**
     * Gets salt
     *
     * @return string
     */
    public function get_salt() {
        return $this->salt;
    }

    /**
     * Sets role
     *
     * @param string $role
     */
    public function set_role($role) {
        $this->role = $role;
    }

    /**
     * Gets role
     *
     * @return string
     */
    public function get_role() {
        return $this->role;
    }

    /**
     * Sets username
     *
     * @param int $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Sets salt
     *
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Sets role
     *
     * @param string $role
     */
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }


}
