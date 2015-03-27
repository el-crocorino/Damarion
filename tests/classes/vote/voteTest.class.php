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

            $this->vote2 = new vote();
            $this->vote2->load(9999);
            $this->assertEquals(0, $this->vote2->get_id());

        }

        public function testSave() {

            $this->vote->load(1);
            $this->vote->set_user_id(2);
            $this->vote->set_question_id(2);
            $this->vote->set_answer_id(3);
            $this->vote->save();

            $this->vote->load(1);

            $this->assertEquals(1, $this->vote->get_id());
            $this->assertEquals(2, $this->vote->get_user_id());
            $this->assertEquals(2, $this->vote->get_question_id());
            $this->assertEquals(3, $this->vote->get_answer_id());

            $this->vote->set_user_id(1);
            $this->vote->set_question_id(1);
            $this->vote->set_answer_id(1);
            $this->vote->save();

        }

        public function testDelete() {

            $this->vote2 = new vote();
            $this->vote->set_user_id(2);
            $this->vote->set_question_id(2);
            $this->vote->set_answer_id(3);

            $this->vote2->save();

            $id = $this->vote2->get_id();

            $this->vote2->delete();

            $this->vote3 = new vote();
            $this->vote3->load($id);

            $this->assertEquals(0, $this->vote3->get_id());

        }

    }
