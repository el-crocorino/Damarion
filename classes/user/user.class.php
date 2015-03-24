<?php

    class user extends user_orm {

        public function hash_password($password) {

            check_string($password, 'password');

            $options = [
                'cost' => 12,
            ];

            $this->set_password(password_hash($password, PASSWORD_BCRYPT, $options));

        }

        public function check_password($password) {
            return password_verify($password, $this->get_password());
        }

    }
