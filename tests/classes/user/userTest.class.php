<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class userTest extends base {

        protected $user = NULL;

        public function setUp() {
            $this->load_config();
            $this->user = new user();
        }

        public function testSetTitle() {

            $this->assertEmpty($this->user->get_id());
            $this->assertEmpty($this->user->get_username());

            $this->user->set_id(1);
            $this->user->set_username('olivier');

            $this->assertEquals(1, $this->user->get_id());
            $this->assertEquals('olivier', $this->user->get_username());

        }

        public function testLoadById() {

            $this->assertEmpty($this->user->get_id());
            $this->assertEmpty($this->user->get_username());

            $this->user->load(1);

            $this->assertEquals(1, $this->user->get_id());
            $this->assertEquals('olivier', $this->user->get_username());

            $this->assertFalse($this->user->load(9999));

        }

    }
