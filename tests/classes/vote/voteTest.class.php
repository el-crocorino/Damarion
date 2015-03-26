<?php

    chdir(dirname(__FILE__));

    require_once '../../base.class.php';

    class voteTest extends base {

        protected $vote = NULL;

        public function setUp() {
            $this->load_config();
            $this->vote = new vote();
        }

        public function testSetTitle() {

            $this->assertEmpty($this->vote->get_id());
            $this->assertEmpty($this->vote->get_user_id());
            $this->assertEmpty($this->vote->get_question_id());
            $this->assertEmpty($this->vote->get_answer_id());

            $this->vote->set_id(1);
            $this->vote->set_user_id(1);
            $this->vote->set_question_id(1);
            $this->vote->set_answer_id(1);

            $this->assertEquals(1, $this->vote->get_id());
            $this->assertEquals(1, $this->vote->get_user_id());
            $this->assertEquals(1, $this->vote->get_question_id());
            $this->assertEquals(1, $this->vote->get_answer_id());

        }

        public function testLoadById() {

            $this->assertEmpty($this->vote->get_id());
            $this->assertEmpty($this->vote->get_user_id());
            $this->assertEmpty($this->vote->get_question_id());
            $this->assertEmpty($this->vote->get_answer_id());

            $this->vote->load(1);

            $this->assertEquals(1, $this->vote->get_id());
            $this->assertEquals(1, $this->vote->get_user_id());
            $this->assertEquals(1, $this->vote->get_question_id());
            $this->assertEquals(1, $this->vote->get_answer_id());

            $this->assertFalse($this->vote->load(9999));

        }

    }
