<?php

    /**
     * dbException class of Infomaniak
     *
     * @package exception
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class dbException extends Exception {

        public function __construct($message, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);
        }

    }
