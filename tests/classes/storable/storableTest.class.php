<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class storableTest extends base {

        public function setUp() {

            $this->load_config();
            $this->student_1 = new Student('Olivier', 'Wenzek', 1);
            $this->student_2 = new Student('Wedge', 'Antilles', 2);

        }

        public function testStorableToArray() {

            $student_array = array(
                'first_name' => 'Olivier',
                'last_name' => 'Wenzek',
                'id' => 1
            );

            $this->assertEquals($student_array, $this->student_1->to_array());

        }

        public function testProcessArray() {

            $students_list = new item_list(item_list::STUDENTS);

            $students_list->add_item($this->student_1);
            $students_list->add_item($this->student_2);

            $list_array = array(
                'list' => array(
                    array(
                        'first_name' => 'Olivier',
                        'last_name' => 'Wenzek',
                        'id' => 1
                    ),
                    array(
                        'first_name' => 'Wedge',
                        'last_name' => 'Antilles',
                        'id' => 2
                    )
                ),
                'type' => item_list::STUDENTS
            );

            $this->assertEquals($list_array, $students_list->to_array());

        }

    }
