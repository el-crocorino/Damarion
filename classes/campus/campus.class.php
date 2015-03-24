<?php

    /**
     * campus class of Infomaniak
     *
     * @package campus
     * @author  Olivier Wenzek <owenzek@gmail.com>
     */

    class campus extends storable {

        /**
         * Campus city
         *
         * @var string
         */
        protected $city = '';

        /**
         * Campus area
         *
         * @var string
         */
        protected $area = '';

        /**
         * Campus capacity
         *
         * @var string
         */
        protected $capacity = 0;

        /**
         * Campus students
         *
         * @var item_list object
         */
        protected $students_list = NULL;

        /**
         * Campus teachers
         *
         * @var item_list object
         */
        protected $teachers_list = NULL;

        public function __construct($city = '', $area ='', $capacity = 0) {

            $this->set_city($city);
            $this->set_area($area);
            $this->set_capacity($capacity);

            $students_list = new item_list(item_list::STUDENTS);
            $this->set_students_list($students_list);

            $teachers_list = new item_list(item_list::TEACHERS);
            $this->set_teachers_list($teachers_list);

        }

        /**
         * Sets campus city
         *
         * @param string $city Campus city name
         * @return void
         */
        public function set_city($city) {
            check_string($city, 'city');
            $this->city = $city;
        }

        /**
         * Gets city
         *
         * @return string Campus city name
         */
        public function get_city() {
            return $this->city;
        }

        /**
         * Sets campus area
         *
         * @param string $area Campus area name
         * @return void
         */
        public function set_area($area) {
            check_string($area, 'area');
            $this->area = $area;
        }

        /**
         * Gets area
         *
         * @return string Campus area name
         */
        public function get_area() {
            return $this->area;
        }

        /**
         * Sets campus capacity
         *
         * @param string $capacity Campus capacity name
         * @return void
         */
        public function set_capacity($capacity) {
            check_int($capacity, 'capacity');
            $this->capacity = $capacity;
        }

        /**
         * Gets capacity
         *
         * @return string Campus capacity name
         */
        public function get_capacity() {
            return $this->capacity;
        }

        /**
         * Sets campus students
         *
         * @param List object $students Students list
         * @return void
         */
        public function set_students_list($students) {
            $this->students_list = $students;
        }

        /**
         * Gets student list
         *
         * @return array Students list
         */
        public function get_students_list() {
            return $this->students_list;
        }

        /**
         * Sets campus teachers
         *
         * @param List object $teachers Teachers list
         * @return void
         */
        public function set_teachers_list($teachers) {
            $this->teachers_list = $teachers;
        }

        /**
         * Adds teacher
         *
         * @return array Teachers list
         */
        public function get_teachers_list() {
            return $this->teachers_list;
        }

        /**
         * Checks if campus is full
         *
         * @return boolean
         */
        public function is_full() {

            if (count($this->get_students()) >= $this->get_capacity()) {
                return true;
            }

            return false;

        }

        /**
         * Checks if campus are equal
         *
         * @param campus $campus
         * @return bool
         */
        public function are_campus_equal(campus $campus) {

            if ($this->get_city() == $campus->get_city() && $this->get_area() == $campus->get_area()) {
                return true;
            }

            return false;

        }

        /**
         * Adds student
         *
         * @param student $student
         * @return void
         */
        public function add_student(student $student) {

            if ($this->is_full()) {

                throw new fullCampusException('Campus is full, student ' . $student->get_first_name() . ' ' . $student->get_last_name() . ' with id ' . $student->get_id() . ' could not be registered in ' . $this->get_city() . ', ' . $this->get_area(), 1);
            } else {
                $this->get_students_list()->add_item($student);
            }

        }

        /**
         * Removes student
         *
         * @param student $student
         * @return void
         */
        public function remove_student(student $student) {
            $this->get_students_list()->remove_item($student);
        }

        /**
         * Gets students array
         *
         * @return array Students list array
         */
        public function get_students() {
            return $this->get_students_list()->get_list();
        }

        /**
         * Adds teacher
         *
         * @param teacher $teacher
         * @return void
         */
        public function add_teacher(teacher $teacher) {
            $this->get_teachers_list()->add_item($teacher);

        }

        /**
         * Removes teacher
         *
         * @param teacher $teacher
         * @return void
         */
        public function remove_teacher(teacher $teacher) {
            $this->get_teachers_list()->remove_item($teacher);

        }

        /**
         * Gets teacher array
         *
         * @return array Teacher list array
         */
        public function get_teachers() {
            return $this->get_teachers_list()->get_list();
        }

        /**
         * Loads Campus data
         *
         * @param array $campus_data
         * @return void
         */
        public function load($campus_data) {

            $this->set_city($campus_data['city']);
            $this->set_area($campus_data['area']);
            $this->set_capacity($campus_data['capacity']);

            if (!empty($campus_data['students_list'])) {

                foreach ($campus_data['students_list']['list'] AS $student_data) {

                    $student = student::load($student_data);
                    $this->add_student($student);

                }

            }

            if (!empty($campus_data['teachers_list'])) {

                foreach ($campus_data['teachers_list']['list'] AS $teacher_data) {

                    if ($teacher_data['type'] == teacher::EXTERNAL) {
                        $classname = 'external_teacher';
                    } else {
                        $classname = 'internal_teacher';
                    }

                    $teacher = $classname::load($teacher_data);
                    $this->add_teacher($teacher);

                }

            }

        }

    }
