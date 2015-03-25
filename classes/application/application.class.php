<?php

    /**
     * application class of Infomaniak
     *
     * @package application
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class application extends storable  {

        /**
         * Campus list
         *
         * @var array
         */
        protected $campus_list = array();

        /**
         * Internal teacher salary amount (only used for backup purpose)
         *
         * @var array
         */
        protected $internal_salary_amount = 0;

        public function add_campus(campus $campus) {
            check_object($campus, 'campus');
            $this->campus_list[] = $campus;
        }

        /**
         * Sets Internal salary amount
         *
         * @return void
         */
        public function set_internal_salary_amount() {
            $salary = salary::get_instance();
            $this->internal_salary_amount = $salary->get_amount();
        }

        /**
         * Gets Campus list
         *
         * @return array Campus list
         */
        public function get_campus_list() {
            return $this->campus_list;
        }

        /**
         * Loads application data
         *
         * @param string $string Json string
         * @return void
         */
        public function load_data($json_string) {

            check_string($json_string, 'json_string');

            if (!$this->is_valid_json($json_string)) {
                throw new wrongTypeException('Given Json string is not valid, please check.', 1);
            } else {

                $app_data = json_decode($json_string, true);

                foreach ($app_data['campus_list'] AS $campus_data) {

                    $campus = new campus();
                    $campus->load($campus_data);
                    $this->add_campus($campus);

                }

                $salary = salary::get_instance();
                $salary->set_amount($app_data['internal_salary_amount']);

                $this->set_internal_salary_amount();

            }

        }

        /**
         * Saves application data
         *
         * @return void
         */
        public function save_data() {

            $this->delete_backup_files();
            $file = config::get('paths/base_path') . config::get('paths/save') . date('Y-m-d_H-i-s') . '_infomaniak_save';
            file_put_contents($file, json_encode($this->to_array(), JSON_UNESCAPED_UNICODE));

        }

        /**
         * Checks if string is valid json
         *
         * @param string $json_string Json string
         * @return boolean
         */
        public function is_valid_json($json_string) {

            check_string($json_string, 'json_string');
            json_decode($json_string);

            return (json_last_error() == JSON_ERROR_NONE);

        }

        /**
         * Loads backup file
         *
         * @param  string $file_path
         * @return void
         */
        public function load_file($file_path) {
            $json_source = file_get_contents($file_path);
            $this->load_data($json_source);
        }

        /**
         * Deletes backup files
         *
         * @return void
         */
        public function delete_backup_files() {

            $backup_files = array();

            if ($handle = opendir(config::get('paths/base_path') . config::get('paths/save'))) {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {
                        $backup_files[] = $entry;
                    }

                }

                closedir($handle);
            }

            if (!empty($backup_files)) {

                foreach ($backup_files AS $file) {
                    unlink($file_path = config::get('paths/base_path') . config::get('paths/save') . $file);
                }

            }


        }

    }
