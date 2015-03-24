<?php

    /**
     * storable class of Infomaniak
     *
     * @package storable
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    abstract class storable {

        public function to_array() {
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
        }

    }

