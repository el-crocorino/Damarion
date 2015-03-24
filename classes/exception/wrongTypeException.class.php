<?php

    /**
     * wrongTypeException class of Infomaniak
     *
     * @package exception
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class wrongTypeException extends Exception {

        public function __construct($message, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
        }

    }
