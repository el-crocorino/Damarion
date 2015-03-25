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

        }

    }
