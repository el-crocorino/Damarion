<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class item_listTest extends base {

        public function setUp() {

            $this->load_config();

            $this->students_list = new item_list(item_list::STUDENTS);
            $this->teachers_list = new item_list(item_list::TEACHERS);

            $this->student_1 = new Student('Olivier', 'Wenzek', 1);
            $this->student_2 = new Student('Boba', 'Fett', 1);
            $this->student_3 = new Student('Han', 'Solo');
            $this->student_4 = new Student('Leia', 'Organa');
            $this->student_5 = new Student('Leia', 'Organa');
            $this->student_6 = new Student('Wedge', 'Antilles', 2);

            $this->internal_teacher_1 = new internal_teacher('John', 'Keating', 1, internal_teacher::INTERNAL);
            $this->internal_teacher_2 = new internal_teacher('Severus', 'Snape', 2, internal_teacher::INTERNAL);
            $this->external_teacher_1 = new external_teacher('Emmet', 'Brown', 3, external_teacher::EXTERNAL, 2000);
            $this->external_teacher_2 = new external_teacher('Remus', 'Lupin', 4, external_teacher::EXTERNAL, 3000);

        }

        public function testSetList() {

            $list = array($this->student_1, $this->student_2, $this->student_3, $this->student_4);

            $this->students_list->set_list($list);
            $this->assertEquals($list, $this->students_list->get_list());

        }

        public function testSetType() {

            $this->students_list->set_type(item_list::TEACHERS);
            $this->assertEquals(item_list::TEACHERS, $this->students_list->get_type());

        }

        public function testAddItem() {

            $this->assertEmpty($this->students_list->get_list());
            $this->students_list->add_item($this->student_1);

            $this->assertEquals(1, count($this->students_list->get_list()));
            $this->assertEquals('Olivier', $this->students_list->get_list()[0]->get_first_name());

        }

        public function testRemoveItem() {

            $this->students_list->add_item($this->student_1);

            $this->assertEquals(1, count($this->students_list->get_list()));
            $this->assertEquals('Olivier', $this->students_list->get_list()[0]->get_first_name());

            $this->students_list->remove_item($this->student_1);

            $this->assertEmpty($this->students_list->get_list());

            $this->students_list->add_item($this->student_1);
            $this->students_list->add_item($this->student_6);

            $this->assertEquals(2, count($this->students_list->get_list()));
            $this->assertEquals('Wedge', $this->students_list->get_list()[1]->get_first_name());

            $this->students_list->remove_item($this->student_1);

            $this->assertEquals(1, count($this->students_list->get_list()));
            $this->assertEquals('Wedge', $this->students_list->get_list()[0]->get_first_name());

        }

        public function testSortList() {

            $list = array($this->student_1, $this->student_2, $this->student_3, $this->student_4, $this->student_5, $this->student_6);

            $this->students_list->set_list($list);
            $this->students_list->sort_list();

            $this->assertEquals(4, count($this->students_list->get_list()));
            $this->assertEquals('Han', $this->students_list->get_list()[0]->get_first_name());
            $this->assertEquals('Leia', $this->students_list->get_list()[1]->get_first_name());
            $this->assertEquals('Boba', $this->students_list->get_list()[2]->get_first_name());
            $this->assertEquals('Wedge', $this->students_list->get_list()[3]->get_first_name());

        }

        public function testClearList() {

            $list = array($this->student_1, $this->student_2, $this->student_3, $this->student_4, $this->student_5, $this->student_6);

            $this->students_list->set_list($list);
            $this->students_list->clear_list();

            $this->assertEquals(4, count($this->students_list->get_list()));
            $this->assertEquals('Boba', $this->students_list->get_list()[0]->get_first_name());
            $this->assertEquals('Han', $this->students_list->get_list()[1]->get_first_name());
            $this->assertEquals('Leia', $this->students_list->get_list()[2]->get_first_name());
            $this->assertEquals('Wedge', $this->students_list->get_list()[3]->get_first_name());

        }

        public function testSortListByItemId() {

            $list = array($this->student_6, $this->student_1);

            $sorted_list = $this->students_list->get_item_list_sorted_by_id($list);

            $this->assertEquals('Olivier', $sorted_list[0]->get_first_name());
            $this->assertEquals('Wedge', $sorted_list[1]->get_first_name());

        }


    }
