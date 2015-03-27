<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class answerTest extends base {

        protected $answer = NULL;

        public function setUp() {
            $this->load_config();
            $this->answer = new answer();
        }

        public function testSetProperties() {

            $this->assertEmpty($this->answer->get_id());
            $this->assertEmpty($this->answer->get_question_id());
            $this->assertEmpty($this->answer->get_text());
            $this->assertFalse($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->answer->set_id(1);
            $this->answer->set_question_id(1);
            $this->answer->set_text('Un marron');
            $this->answer->set_right(true);
            $this->answer->set_active(false);

            $this->assertEquals(1, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un marron', $this->answer->get_text());
            $this->assertTrue($this->answer->get_right());
            $this->assertFalse($this->answer->get_active());

        }

        public function testLoadById() {

            $this->assertEmpty($this->answer->get_id());
            $this->assertEmpty($this->answer->get_question_id());
            $this->assertEmpty($this->answer->get_text());
            $this->assertFalse($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->answer->load(5);

            $this->assertEquals(5, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un marron', $this->answer->get_text());
            $this->assertTrue($this->answer->get_right());
            $this->assertFalse($this->answer->get_active());

            $this->answer->load(6);

            $this->assertEquals(6, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un ours', $this->answer->get_text());
            $this->assertFalse($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->answer2 = new answer();
            $this->answer2->load(9999);
            $this->assertEquals(0, $this->answer2->get_id());

        }

        public function testSave() {

            $this->answer->load(5);

            $this->answer->set_question_id(3);
            $this->answer->set_text('Un schtroumph');
            $this->answer->set_right(false);
            $this->answer->set_active(true);

            $this->answer->save();

            $this->answer->load(5);

            $this->assertEquals(5, $this->answer->get_id());
            $this->assertEquals(3, $this->answer->get_question_id());
            $this->assertEquals('Un schtroumph', $this->answer->get_text());
            $this->assertFalse($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->answer->set_question_id(1);
            $this->answer->set_text('Un marron');
            $this->answer->set_right(true);
            $this->answer->set_active(false);
            $this->answer->save();

        }

        public function testDelete() {

            $this->answer2 = new answer();
            $this->answer->set_question_id(3);
            $this->answer->set_text('Un schtroumph');
            $this->answer->set_right(false);
            $this->answer->set_active(true);

            $this->answer2->save();

            $id = $this->answer2->get_id();

            $this->answer2->delete();

            $this->answer3 = new answer();
            $this->answer3->load($id);

            $this->assertEquals(0, $this->answer3->get_id());

        }

    }
