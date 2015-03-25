<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class dbTest extends base {

        protected $db_slave = NULL;
        protected $db_master = NULL;

        public function setUp() {

            $this->load_config();

        }

        public function testSetDb() {

            $this->db_master = dbmanager::get_master();
            $this->db_slave = dbmanager::get_slave();

            $this->assertInstanceOf('db', $this->db_master);
            $this->assertInstanceOf('db', $this->db_slave);

        }

        public function testGet() {

            $this->db_master = dbmanager::get_master();
            $this->db_slave = dbmanager::get_slave();

            $game_master = $this->db_master->get('game', '', array('game_id = 1'), array(), array());
            $game_slave = $this->db_slave->get('game', '', array('game_id = 1'), array(), array());

            $this->assertEquals('test', $game_master['game_title']);
            $this->assertEquals('test', $game_slave['game_title']);

        }

    }
