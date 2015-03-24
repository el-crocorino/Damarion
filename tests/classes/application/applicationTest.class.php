<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class applicationTest extends base {

        protected $app = NULL;

        public function setUp() {

            $this->load_config();

            $this->app = new application();
            $this->app2 = new application();

            $this->campus_1 = new campus('Montpellier', 'Languedoc-Roussillon', 4);
            $this->campus_2 = new campus('Lyon', 'Rhône-Alpes', 6);
            $this->campus_3 = new campus('Montpellier', 'Languedoc-Roussillon', 4);

            $this->campus_json_data = '{"campus_list":[{"city":"Montpellier","area":"Languedoc-Roussillon","capacity":4,"students_list":{"list":[{"first_name":"Han","last_name":"Solo","id":0},{"first_name":"Leia","last_name":"Organa","id":0},{"first_name":"Boba","last_name":"Fett","id":1},{"first_name":"Wedge","last_name":"Antilles","id":2}],"type":0},"teachers_list":{"list":[{"first_name":"John","last_name":"Keating","id":1,"type":0},{"first_name":"Severus","last_name":"Snape","id":2,"type":0},{"salary":2000,"first_name":"Emmet","last_name":"Brown","id":3,"type":1},{"salary":3000,"first_name":"Remus","last_name":"Lupin","id":4,"type":1}],"type":1}},{"city":"Lyon","area":"Rhônes-Alpes","capacity":2,"students_list":{"list":[{"first_name":"Luke","last_name":"Skywalker","id":0},{"first_name":"Lando","last_name":"Calrissian","id":1}],"type":0},"teachers_list":{"list":[{"first_name":"Herbert","last_name":"Garrison","id":1,"type":0},{"salary":4000,"first_name":"Jerome","last_name":"McElroy","id":3,"type":1}],"type":1}}],"internal_salary_amount":2500}';

        }

        public function testSetCampus() {

            $this->assertEmpty($this->app->get_campus_list());

            $this->app->add_campus($this->campus_1);

            $this->assertEquals(1, count($this->app->get_campus_list()));
            $this->assertInstanceOf('campus', $this->app->get_campus_list()[0]);

            $this->app->add_campus($this->campus_2);
            $this->app->add_campus($this->campus_3);

            $this->assertEquals(3, count($this->app->get_campus_list()));
            $this->assertInstanceOf('campus', $this->app->get_campus_list()[1]);
            $this->assertInstanceOf('campus', $this->app->get_campus_list()[2]);

        }

        public function testIsValidJson() {
            $this->assertTrue($this->app->is_valid_json($this->campus_json_data));
            $this->assertFalse($this->app->is_valid_json('{]'));
        }

        public function testLoadAppData() {
            $this->app->load_data($this->campus_json_data);
            $this->assertEquals(2, count($this->app->get_campus_list()));
        }

        public function testLoadAppDataException() {
            $this->setExpectedException('wrongTypeException');
            $this->app->load_data('{]}');
        }

        public function testSaveAppData() {

            $this->app->load_data($this->campus_json_data);
            $this->app->save_data();

            $file_path = config::get('paths/base_path') . config::get('paths/save') . date('Y-m-d_H-i-s') . '_infomaniak_save';

            $saved_json = file_get_contents($file_path);
            $this->assertEquals($this->campus_json_data, $saved_json);

        }

        public function testLoadAppFile() {

            $backup_files = array();

            if ($handle = opendir(config::get('paths/base_path') . config::get('paths/save'))) {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {
                        $backup_files[] = $entry;
                    }

                }

                closedir($handle);
            }

            $file_path = config::get('paths/base_path') . config::get('paths/save') . $backup_files[max(array_keys($backup_files))];

            $this->app->load_file($file_path);
            $this->app2->load_data($this->campus_json_data);

            $this->assertEquals($this->app->get_campus_list(), $this->app2->get_campus_list());

        }

    }
