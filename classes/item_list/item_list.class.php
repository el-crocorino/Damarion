<?php

    /**
     * item_list class of Infomaniak
     *
     * @package list
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class item_list extends storable {

        /**
         * List list
         *
         * @var string
         */
        protected $list = array();

        /**
         * List type
         *
         * @var string
         */
        protected $type = 0;

        const STUDENTS = 0;
        const TEACHERS = 1;

        /**
         * Sets List list
         *
         * @param array $list
         * @return void
         */
        public function set_list($list) {
            check_array($list, 'list');
            $this->list = $list;
        }

        /**
         * Gets list
         *
         * @return array List list
         */
        public function get_list() {
            return $this->list;
        }

        /**
         * Sets List type
         *
         * @param int $type List type
         * @return void
         */
        public function set_type($type) {
            check_int($type, 'type');
            $this->type = $type;
        }

        /**
         * Gets type
         *
         * @return int List type
         */
        public function get_type() {
            return $this->type;
        }

        public function __construct($type) {
            $this->set_type($type);
        }

        /**
         * Adds item to list
         *
         * @param mixed $item Student or teacher object
         * @return void
         */
        public function add_item($item) {
            array_push($this->list, $item);
            $this->sort_list();
        }

        /**
         * Removes list item
         *
         * @param mixed $item Student or teacher object
         * @return void
         */
        public function remove_item($item) {

            foreach ($this->get_list() AS $key => $value) {

                switch ($this->get_type()) {

                    case self::STUDENTS:

                        if ($item->are_students_equal($value)) {
                            unset($this->list[$key]);
                        }

                        break;

                    case self::TEACHERS:

                        if ($item->get_id() == $value->get_id()) {
                            unset($this->list[$key]);
                        }

                        break;

                }

            }

            $this->sort_list();

        }

        /**
         * Sorts list
         *
         * @return boolean
         */
        public function sort_list() {

            $this->clear_list();

            $items_without_id = array();
            $items_with_id = array();

            foreach ($this->list AS $item) {

                if ($item->get_id() > 0) {
                    $items_with_id[] = $item;
                } else {
                    $items_without_id[] = $item;
                }

            }

            $this->get_item_list_sorted_by_id($items_with_id);

            $sorted_list = array();

            foreach ($items_without_id AS $item) {
                $sorted_list[] = $item;
            }

            foreach ($items_with_id AS $item) {
                $sorted_list[] = $item;
            }

            $this->set_list($sorted_list);

        }

        /**
         * Clears list from doubles
         *
         * @param array $list
         * @return array Cleaned list
         */
        public function clear_list() {

            $temp_list = array();
            $cleared_list = array();

            foreach ($this->get_list() AS $index => $item) {

                if ($item->get_id() > 0 ) {
                    $key = $item->get_id();
                } else {
                    $key = $item->get_last_name() . '_' . $item->get_last_name();
                }

                $temp_list[$key] = $item;

            }

            foreach ($temp_list AS $value) {
                $cleared_list[] = $value;
            }

            $this->set_list($cleared_list);

        }

        /**
         * Gets item list sorted by id
         *
         * @param array $list
         * @return array item list sorted by id
         */
        public function get_item_list_sorted_by_id($list) {

            $temp_list = array();

            foreach ($list AS $item) {
                $temp_list[$item->get_id()] = $item;
            }

            sort($temp_list);

            return $temp_list;

        }

    }
