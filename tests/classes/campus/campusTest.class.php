<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class campusTest extends base {

        protected $campus_1 = NULL;

        public function setUp() {

            $this->load_config();

            $this->campus_1 = new campus('Montpellier', 'Languedoc-Roussillon', 4);
            $this->campus_2 = new campus('Montpellier', 'Languedoc-Roussillon');
            $this->campus_3 = new campus('Nantes', 'Bretagne', 3);

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

        public function testGetCampusCity() {
            $this->assertEquals('Montpellier', $this->campus_1->get_city());
        }

        public function testGetCampusArea() {
            $this->assertEquals('Languedoc-Roussillon', $this->campus_1->get_area());
        }

        public function testGetCampusCapacity() {
            $this->assertEquals('4', $this->campus_1->get_capacity());
        }

        public function testSetCampusCity() {
            $this->campus_2->set_city('Lyon');
            $this->assertEquals('Lyon', $this->campus_2->get_city());
        }

        public function testSetCampusArea() {
            $this->campus_2->set_area('Rhône-Alpes');
            $this->assertEquals('Rhône-Alpes', $this->campus_2->get_area());
        }

        public function testSetCampusCapacity() {
            $this->campus_2->set_capacity(6);
            $this->assertEquals('6', $this->campus_2->get_capacity());
        }

        public function testCompareCampus() {
            $this->assertFalse($this->campus_1->are_campus_equal($this->campus_3));
            $this->assertTrue($this->campus_1->are_campus_equal($this->campus_2));
        }

        public function testAddStudent() {

            $this->campus_1->add_student($this->student_1);
            $this->assertEquals(1, count($this->campus_1->get_students()));
            $this->assertEquals('Olivier', $this->campus_1->get_students()[0]->get_first_name());

        }

        public function testAddStudents() {

            $this->campus_1->add_student($this->student_1);
            $this->campus_1->add_student($this->student_2);
            $this->campus_1->add_student($this->student_3);
            $this->campus_1->add_student($this->student_4);
            $this->campus_1->add_student($this->student_5);
            $this->campus_1->add_student($this->student_6);

            $this->assertEquals(4, count($this->campus_1->get_students()));

            $this->assertEquals('Han', $this->campus_1->get_students()[0]->get_first_name());
            $this->assertEquals('Leia', $this->campus_1->get_students()[1]->get_first_name());
            $this->assertEquals('Boba', $this->campus_1->get_students()[2]->get_first_name());
            $this->assertEquals('Wedge', $this->campus_1->get_students()[3]->get_first_name());

        }

        public function testCampusIsFull() {

            $this->setExpectedException('fullCampusException');

            $this->campus_1->set_capacity(2);
            $this->campus_1->add_student($this->student_1);

            $this->assertFalse($this->campus_1->is_full());

            $this->campus_1->add_student($this->student_3);
            $this->campus_1->add_student($this->student_4);

            $this->assertTrue($this->campus_1->is_full());

        }

        public function testRemoveStudent() {

            $this->campus_1->add_student($this->student_1);
            $this->campus_1->add_student($this->student_3);
            $this->campus_1->add_student($this->student_4);

            $this->campus_1->remove_student($this->student_4);

            $this->assertEquals(2, count($this->campus_1->get_students()));

        }

        public function testAddTeacher() {
            $this->campus_1->add_teacher($this->internal_teacher_1);
            $this->assertEquals(1, count($this->campus_1->get_teachers()));
        }

        public function testAddTeachers() {

            $this->campus_1->add_teacher($this->internal_teacher_1);
            $this->campus_1->add_teacher($this->internal_teacher_2);
            $this->campus_1->add_teacher($this->external_teacher_1);
            $this->campus_1->add_teacher($this->external_teacher_2);

            $this->assertEquals(4, count($this->campus_1->get_teachers()));

        }

        public function testRemoveTeacher() {

            $this->campus_1->add_teacher($this->internal_teacher_1);
            $this->campus_1->add_teacher($this->internal_teacher_2);
            $this->campus_1->add_teacher($this->external_teacher_1);
            $this->campus_1->add_teacher($this->external_teacher_2);

            $this->campus_1->remove_teacher($this->external_teacher_2);

            $this->assertEquals(3, count($this->campus_1->get_teachers()));

        }

        public function testLoadCampus() {

            $campus_data = '{"city":"Nantes","area":"Bretagne","capacity":3,"students_list":{"list":[{"first_name":"Luke","last_name":"Skywalker","id":0},{"first_name":"Lando","last_name":"Calrissian","id":1}],"type":0},"teachers_list":{"list":[{"first_name":"Herbert","last_name":"Garrison","id":1,"type":0},{"salary":4000,"first_name":"Jerome","last_name":"McElroy","id":3,"type":1}],"type":1}}';

            $campus_data = json_decode($campus_data, true);

            $campus = new campus();
            $campus->load($campus_data);

            $this->assertEquals('Nantes', $campus->get_city());
            $this->assertEquals('Bretagne', $campus->get_area());
            $this->assertEquals(3, $campus->get_capacity());

            $this->assertEquals(2, count($campus->get_students()));
            $this->assertEquals(2, count($campus->get_teachers()));

            $this->assertEquals('Luke', $campus->get_students()[0]->get_first_name());
            $this->assertEquals('Herbert', $campus->get_teachers()[0]->get_first_name());

        }

    }
