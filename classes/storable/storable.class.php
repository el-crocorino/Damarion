<?php

    /**
     * storable class of Infomaniak
     *
     * @package storable
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    abstract class storable {

        protected $types = array(
            'boolean' => 'boolean',
            'integer' => 'int',
            'string' => 'string'
            );

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


        /**
        * Sets membervar / Returns membervar if exist
        *
        * @param string $method Method whichs called
        * @param array $arg Arguments
        * @return void / $var
        */
        public function __call($method, $arg) {

            $var = substr($method, 4);
dump(get_object_vars($this));
            if (substr($method, 0, 4) == 'set_' && array_key_exists($var, get_object_vars($this))) {
                $this->$var = $arg[0];
            } elseif (substr($method, 0, 4) == 'get_' && array_key_exists($var, get_object_vars($this))) {
                return $this->$var;
            } else {
                throw new rs_basic_exception('Method ' . get_class($this) . '::' . $method . '() does not exist.');
            }

        }

        /**
         * Saves item
         *
         * @return void
         */
        public function save() {

            $db = dbmanager::get_master();

            $res = $db->get_value(get_class($this), $this->get_id());

            if (!$res) {
                $db->save($this);
            } else {
                $db->update($this);
            }

        }

        /**
         * Loads item from db with id
         *
         * @param int $id Game id
         * @return void
         */
        public function load($id) {

            check_int($id, 'id');

            $db = dbmanager::get_slave();

            $data = $db->get_value(get_class($this), $id);

            if (!empty($data)) {

                foreach ($data AS $index => $item) {
                    $method = 'set_' . substr($index, $this->table_prefix_length);
                    $this->$method($item);
                }

            }

        }

        public function get_object_db_fields() {

        }

    }


