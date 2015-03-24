<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class internal_teacherTest extends base {

        protected $internal_teacher_1 = NULL;
        protected $internal_teacher_2 = NULL;

        public function setUp() {

            $this->load_config();

            $this->internal_teacher_1 = new internal_teacher('John', 'Keating', 1, teacher::INTERNAL);
            $this->internal_teacher_2 = new internal_teacher('Severus', 'Snape', 2, teacher::INTERNAL);

            $this->salary = salary::get_instance();

        }

        public function testGetInternalTeacherFirstName() {
            $this->assertEquals('John', $this->internal_teacher_1->get_first_name());
        }

        public function testGetInternalTeacherLastName() {
            $this->assertEquals('Keating', $this->internal_teacher_1->get_last_name());
        }

        public function testGetInternalTeacherId() {
            $this->assertEquals(1, $this->internal_teacher_1->get_id());
        }

        public function testGetInternalTeacherType() {
            $this->assertEquals(teacher::INTERNAL, $this->internal_teacher_1->get_type());
        }

        public function testGetInternalTeacherSalary() {

            $this->assertEquals(2500, $this->internal_teacher_1->get_salary());
            $this->assertEquals(2500, $this->internal_teacher_2->get_salary());

            $this->salary->set_amount(3500);

            $this->assertEquals(3500, $this->internal_teacher_1->get_salary());
            $this->assertEquals(3500, $this->internal_teacher_2->get_salary());

        }

        public function testSetInternalTeacherFirstName() {
            $this->internal_teacher_2->set_first_name('Charles');
            $this->assertEquals('Charles', $this->internal_teacher_2->get_first_name());
        }

        public function testSetInternalTeacherLastName() {
            $this->internal_teacher_2->set_last_name('Xavier');
            $this->assertEquals('Xavier', $this->internal_teacher_2->get_last_name());
        }

        public function testSetInternalTeacherId() {
            $this->internal_teacher_2->set_id(2);
            $this->assertEquals(2, $this->internal_teacher_2->get_id());
        }

        public function testLoadData() {

            $teacher = internal_teacher::load(array('first_name' => 'Emmet', 'last_name' => 'Brown', 'id' => 1, 'type' => 0));

            $this->assertInstanceOf('teacher', $teacher);
            $this->assertEquals('Emmet', $teacher->get_first_name());
            $this->assertEquals('Brown', $teacher->get_last_name());
            $this->assertEquals(1, $teacher->get_id());
            $this->assertEquals(teacher::INTERNAL, $teacher->get_type());

        }

    }
