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

            $this->user2 = new user();
            $this->user2->load(9999);
            $this->assertEquals(0, $this->user2->get_id());

        }

        public function testSave() {

            $this->user->load(1);
            $this->user->set_username('Bernard');
            $this->user->save();

            $this->user->load(1);

            $this->assertEquals(1, $this->user->get_id());
            $this->assertEquals('Bernard', $this->user->get_username());

            $this->user->set_username('olivier');
            $this->user->save();

        }

        public function testDelete() {

            $this->user2 = new user();
            $this->user2->set_username('Bernard');

            $this->user2->save();

            $id = $this->user2->get_id();

            $this->user2->delete();

            $this->user3 = new user();
            $this->user3->load($id);

            $this->assertEquals(0, $this->user3->get_id());

        }

    }
