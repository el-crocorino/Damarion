<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class salaryTest extends base {

        public function setUp() {
            $this->load_config();

            $this->salary = salary::get_instance();
            $this->salary->set_amount(2500);
        }

        public function testGetSalaryInstance() {
            $this->assertInstanceOf('salary', salary::get_instance());
        }

        public function testGetSalaryAmount() {
            $this->assertEquals(2500, $this->salary->get_amount());
        }

        public function testSetSalaryAmount() {
            $this->salary->set_amount(2000);
            $this->assertEquals(2000, $this->salary->get_amount());
        }

    }
