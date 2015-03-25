<?php

    /**
     * storable class of Infomaniak
     *
     * @package storable
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    abstract class storable {

        /*public function to_array() {
            return $this->process_array(get_object_vars($this));
        }

        private function process_array($array) {

            foreach($array as $key => $value) {

                if (is_object($value)) {
                    $array[$key] = $value->to_array();
                }

                if (is_array($value)) {
                    $array[$key] = $this->process_array($value);
                }

            }

            return $array;
        }*/

        /*public function __call($method, $args) {

            $parts = explode('_', $method);
            $prefix = array_shift($parts);
            $field = array_pop($parts);

            switch ($prefix) {

                case 'get':

                    if (method_exists($this, $method)) {
                        return $this->$field;
                    } else {
                        throw new NoSuchFieldException('Field ' . $field . ' does not exist in ' . __CLASS__ . ' class.');
                    }

                    break;

                case 'set':

                    if (method_exists($this, $method)) {
                        $this->$field = array_shift($args);
                    } else {
                        throw new NoSuchFieldException('Field ' . $field . ' does not exist in ' . __CLASS__ . ' class.');
                    }

                    break;

            }

           return $this->fields[$field];

        }*/

    }


