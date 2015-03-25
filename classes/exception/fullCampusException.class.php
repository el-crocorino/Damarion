<?php

    /**
     * fullCampusException class of Infomaniak
     *
     * @package exception
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class fullCampusException extends RuntimeException {

        public function __construct($message, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
        }

        public function __toString() {
            return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
        }

    }
