<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class questionTest extends base {

        protected $question = NULL;

        public function setUp() {
            $this->load_config();
            $this->question = new question();
        }

        public function testSetTitle() {

            $this->assertEmpty($this->question->get_id());
            $this->assertEmpty($this->question->get_game_id());
            $this->assertEmpty($this->question->get_text());
            $this->assertEmpty($this->question->get_order());

            $this->question->set_id(1);
            $this->question->set_game_id(1);
            $this->question->set_text('Qu\'est-ce qui est petit et marron ?');
            $this->question->set_order(1);

            $this->assertEquals(1, $this->question->get_id());
            $this->assertEquals(1, $this->question->get_game_id());
            $this->assertEquals('Qu\'est-ce qui est petit et marron ?', $this->question->get_text());
            $this->assertEquals(1, $this->question->get_order());

        }

        public function testLoadById() {

            $this->assertEmpty($this->question->get_id());
            $this->assertEmpty($this->question->get_game_id());
            $this->assertEmpty($this->question->get_text());
            $this->assertEmpty($this->question->get_order());

            $this->question->load(1);

            $this->assertEquals(1, $this->question->get_id());
            $this->assertEquals(1, $this->question->get_game_id());
            $this->assertEquals('Qu\'est-ce qui est petit et marron ?', $this->question->get_text());
            $this->assertEquals(1, $this->question->get_order());

            $this->setExpectedException('dbException');
            $this->question->load(9999);

        }

    }
