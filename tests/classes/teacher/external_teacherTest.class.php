<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class external_teacherTest extends base {

        protected $external_teacher_1 = NULL;
        protected $external_teacher_2 = NULL;

        public function setUp() {

            $this->load_config();

            $this->external_teacher_1 = new external_teacher('Emmet', 'Brown', 1, teacher::EXTERNAL, 2000);
            $this->external_teacher_2 = new external_teacher('Remus', 'Lupin', 2, teacher::EXTERNAL, 3000);

        }

        public function testGetExternalTeacherFirstName() {
            $this->assertEquals('Emmet', $this->external_teacher_1->get_first_name());
        }

        public function testGetExternalTeacherLastName() {
            $this->assertEquals('Brown', $this->external_teacher_1->get_last_name());
        }

        public function testGetExternalTeacherId() {
            $this->assertEquals(1, $this->external_teacher_1->get_id());
        }

        public function testGetExternalTeacherType() {
            $this->assertEquals(external_teacher::EXTERNAL, $this->external_teacher_1->get_id());
        }

        public function testGetExternalTeacherSalary() {
            $this->assertEquals(2000, $this->external_teacher_1->get_salary());
        }

        public function testSetExternalTeacherFirstName() {
            $this->external_teacher_2->set_first_name('Charles');
            $this->assertEquals('Charles', $this->external_teacher_2->get_first_name());
        }

        public function testSetExternalTeacherLastName() {
            $this->external_teacher_2->set_last_name('Xavier');
            $this->assertEquals('Xavier', $this->external_teacher_2->get_last_name());
        }

        public function testSetExternalTeacherId() {
            $this->external_teacher_2->set_id(2);
            $this->assertEquals(2, $this->external_teacher_2->get_id());
        }

        public function testSetExternalTeacherSalary() {
            $this->external_teacher_2->set_salary(3000);
            $this->assertEquals(3000, $this->external_teacher_2->get_salary());
        }

        public function testLoadData() {

            $teacher = external_teacher::load(array('first_name' => 'Emmet', 'last_name' => 'Brown', 'id' => 1, 'type' => 1, 'salary' => 2000));

            $this->assertInstanceOf('teacher', $teacher);
            $this->assertEquals('Emmet', $teacher->get_first_name());
            $this->assertEquals('Brown', $teacher->get_last_name());
            $this->assertEquals(1, $teacher->get_id());
            $this->assertEquals(teacher::EXTERNAL, $teacher->get_type());
            $this->assertEquals(2000, $teacher->get_salary());

        }

    }
