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


        /**
        * Sets membervar / Returns membervar if exist
        *
        * @param string $method Method whichs called
        * @param array $arg Arguments
        * @return void / $var
        */
        public function __call($method, $arg) {

            $var = substr($method, 4);

            if (substr($method, 0, 4) == 'set_' && array_key_exists($var, get_object_vars($this))) {
                $this->$var = $arg[0];
            } elseif (substr($method, 0, 4) == 'get_' && array_key_exists($var, get_object_vars($this))) {
                return $this->$var;
            } else {
                throw new dbException('Method ' . get_class($this) . '::' . $method . '() does not exist.');
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
         * Deletes item
         *
         * @return void
         */
        public function delete() {

            $db = dbmanager::get_master();

            $res = $db->get_value(get_class($this), $this->get_id());

            if ($res) {
                $db->delete($this);
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

            $class_name = get_class($this);

            $data = $db->get_value($class_name, $id);

            $data = array_unfix($class_name . '_', $data);

            if (!empty($data)) {

                $data = $class_name::handle_db_data($data);

                foreach ($data AS $index => $item) {
                    $method = 'set_' . $index;
                    $this->$method($item);
                }

            } else {
                $this->set_id(0);
            }

        }

        /**
         * Loads item from db with property
         *
         * @param string $field Field
         * @param mixed $value Field value
         * @return void
         */
        public function load_by_property(string $field, $value) {

            /*check_int($field);

            if is_string($value) {
                $value = '"' . $value . '"';
            }

            $this->set_id($vote_id);

            $where = array($field . ' = ')

            $db = db::get_slave();
            $db->get($this->get_storable_table, $this->get_storable_fields);*/
        }

        public function get_object_db_fields() {

        }

    }


