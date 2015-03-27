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

            $this->assertNull($this->question->load(9999));

        }

        public function testSave() {

            $this->question->load(1);
            $this->question->set_text('Qu\'est-ce qui est petit et bleu ?');
            $this->question->set_order(2);
            $this->question->save();

            $this->question->load(1);

            $this->assertEquals('Qu\'est-ce qui est petit et bleu ?', $this->question->get_text());
            $this->assertEquals(2, $this->question->get_order());

            $this->question->set_text('Qu\'est-ce qui est petit et marron ?');
            $this->question->set_order(1);
            $this->question->save();

        }

        public function testDelete() {

            $this->question2 = new question();
            $this->question->set_game_id(1);
            $this->question->set_text('Qu\'est-ce qui est petit et bleu ?');
            $this->question->set_order(2);

            $this->question2->save();

            $id = $this->question2->get_id();

            $this->question2->delete();

            $this->question3 = new question();
            $this->question3->load($id);

            $this->assertEquals(0, $this->question3->get_id());

        }

    }
