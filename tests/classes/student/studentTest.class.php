<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class studentTest extends base {

        protected $student_1 = NULL;
        protected $student_2 = NULL;

        public function setUp() {

            $this->load_config();

            $this->student_1 = new Student('Olivier', 'Wenzek', 1);
            $this->student_2 = new Student('Boba', 'Fett', 1);
            $this->student_3 = new Student('Han', 'Solo');
            $this->student_4 = new Student('Leia', 'Organa');
            $this->student_5 = new Student('Leia', 'Organa');
            $this->student_6 = new Student('Olivier', 'Wenzek');

        }

        public function testGetStudentFirstName() {
            $this->assertEquals('Olivier', $this->student_1->get_first_name());
        }

        public function testGetStudentLastName() {
            $this->assertEquals('Wenzek', $this->student_1->get_last_name());
        }

        public function testGetStudentId() {
            $this->assertEquals(1, $this->student_1->get_id());
        }

        public function testGetStudentIdWithNoSetId() {
            $this->assertEquals(0, $this->student_3->get_id());
        }

        public function testSetStudentFirstName() {
            $this->student_2->set_first_name('Charles');
            $this->assertEquals('Charles', $this->student_2->get_first_name());
        }

        public function testSetStudentLastName() {
            $this->student_2->set_last_name('Xavier');
            $this->assertEquals('Xavier', $this->student_2->get_last_name());
        }

        public function testSetStudentId() {
            $this->student_2->set_id(2);
            $this->assertEquals(2, $this->student_2->get_id());
        }

        public function testCompareStudentWithSameId() {
            $this->assertTrue($this->student_1->are_students_equal($this->student_2));
        }

        public function testCompareStudentWithNoId() {
            $this->assertFalse($this->student_3->are_students_equal($this->student_4));
            $this->assertTrue($this->student_4->are_students_equal($this->student_5));
        }

        public function testCompareStudentWithAndWhithoutId() {
            $this->assertFalse($this->student_1->are_students_equal($this->student_3));
            $this->assertFalse($this->student_1->are_students_equal($this->student_6));
        }

        public function testLoadData() {

            $student = student::load(array('first_name' => 'Olivier', 'last_name' => 'Wenzek', 'id' => 1));

            $this->assertInstanceOf('student', $student);
            $this->assertEquals('Olivier', $student->get_first_name());
            $this->assertEquals('Wenzek', $student->get_last_name());
            $this->assertEquals(1, $student->get_id());

        }

    }
