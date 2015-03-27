<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class gameTest extends base {

        protected $game = NULL;

        public function setUp() {
            $this->load_config();
            $this->game = new game();
        }

        public function testSetTitle() {

            $this->assertEmpty($this->game->get_id());
            $this->assertEmpty($this->game->get_title());

            $this->game->set_id(1);
            $this->game->set_title('test');

            $this->assertEquals(1, $this->game->get_id());
            $this->assertEquals('test', $this->game->get_title());

        }

        public function testLoadById() {

            $this->assertEmpty($this->game->get_id());
            $this->assertEmpty($this->game->get_title());

            $this->game->load(1);

            $this->assertEquals(1, $this->game->get_id());
            $this->assertEquals('test', $this->game->get_title());

            $this->assertNull($this->game->load(9999));

        }

        public function testSave() {

            $this->game->load(1);
            $this->game->set_title('New test');
            $this->game->save();

            $this->game->load(1);

            $this->assertEquals(1, $this->game->get_id());
            $this->assertEquals('New test', $this->game->get_title());

            $this->game->set_title('test');
            $this->game->save();

        }

        public function testDelete() {

            $this->game2 = new game();
            $this->game2->set_title('test 2');

            $this->game2->save();

            $id = $this->game2->get_id();

            $this->game2->delete();

            $this->game3 = new game();
            $this->game3->load($id);

            $this->assertEquals(0, $this->game3->get_id());

        }

    }
