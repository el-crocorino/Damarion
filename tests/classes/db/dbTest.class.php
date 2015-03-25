<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class dbTest extends base {

        protected $db_slave = NULL;
        protected $db_master = NULL;

        public function setUp() {

            $this->load_config();

        }

        public function testSetCampus() {

            $db_slave = dbmanager::get_master();
            $db_slave = dbmanager::get_slave();

            $this->assertInstanceOf('db', $this->db_master);
            $this->assertInstanceOf('db', $this->db_slave);

        }

    }
