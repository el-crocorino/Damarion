<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class answerTest extends base {

        protected $answer = NULL;

        public function setUp() {
            $this->load_config();
            $this->answer = new answer();
        }

        public function testSetTitle() {

            $this->assertEmpty($this->answer->get_id());
            $this->assertEmpty($this->answer->get_question_id());
            $this->assertEmpty($this->answer->get_text());
            $this->assertEmpty($this->answer->get_right());
            $this->assertEmpty($this->answer->get_active());

            $this->answer->set_id(1);
            $this->answer->set_question_id(1);
            $this->answer->set_text('Un marron');
            $this->answer->set_right(true);
            $this->answer->set_active(true);

            $this->assertEquals(1, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un marron', $this->answer->get_text());
            $this->assertTrue($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

        }

        public function testLoadById() {

            $this->assertEmpty($this->answer->get_id());
            $this->assertEmpty($this->answer->get_question_id());
            $this->assertEmpty($this->answer->get_text());
            $this->assertEmpty($this->answer->get_right());
            $this->assertEmpty($this->answer->get_active());

            $this->answer->load(5);

            $this->assertEquals(5, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un marron', $this->answer->get_text());
            $this->assertTrue($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->answer->load(6);

            $this->assertEquals(6, $this->answer->get_id());
            $this->assertEquals(1, $this->answer->get_question_id());
            $this->assertEquals('Un ours', $this->answer->get_text());
            $this->assertFalse($this->answer->get_right());
            $this->assertTrue($this->answer->get_active());

            $this->assertFalse($this->answer->load(9999));

        }

    }
