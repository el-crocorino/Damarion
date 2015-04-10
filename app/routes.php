<?php

    use Symfony\Component\HttpFoundation\Request;
    use Damarion\Domain\Game;
    use Damarion\Domain\Question;
    use Damarion\Domain\Answer;
    use Damarion\Domain\Vote;
    use Damarion\Domain\User;
    use Damarion\Form\Type\GameType;
    use Damarion\Form\Type\QuestionType;
    use Damarion\Form\Type\AnswerType;
    use Damarion\Form\Type\VoteType;
    use Damarion\Form\Type\UserType;

    // Home page

    $app->get('/', function() use ($app) {

        $questions = $app['dao.question']->find_all();

        $answers = $app['dao.answer']->find_all();
        $games = $app['dao.game']->find_all();
        $users = $app['dao.user']->find_all();
        $votes = $app['dao.vote']->find_all();

        return $app['twig']->render('index.html.twig', array(
            'questions' => $questions,
            'answers' => $answers,
            'games' => $games,
            'users' => $users,
            'votes' => $votes
        ));

    });

    $app->get('/hashpwd', function() use ($app) {

        $rawPassword = 'damarion';
        $salt = '%qUgq3NAYfC1MKwrW?yevbE';
        $encoder = $app['security.encoder.digest'];

        return $encoder->encodePassword($rawPassword, $salt);

    });

    $app->get('/ajax/check', function() use ($app) {

        $question = $app['dao.question']->find_current();

        return $question->get_id();

    });

    $app->match('/ajax/joker/{joker}', function ($joker, Request $request) use ($app) {

        $question = $app['dao.question']->find_current();
        $game = $question->get_game();

        $fn = 'set_' . $joker;

        $game->$fn(true);
        $app['dao.game']->save($game);

        return $question->get_id();

    });

    $app->match('/ajax/prev/{question_order}', function ($question_order, Request $request) use ($app) {

        $prev_order = $question_order - 1;

        $question = $app['dao.question']->find_by_order($question_order);
        $question->set_active(false);
        $app['dao.question']->save($question);

        $prev_question = $app['dao.question']->find_by_order($prev_order);
        $prev_question->set_active(true);
        $app['dao.question']->save($prev_question);

        return $prev_question->get_id();

    });

    $app->match('/ajax/next/{question_order}', function ($question_order, Request $request) use ($app) {

        $next_order = $question_order + 1;

        $question = $app['dao.question']->find_by_order($question_order);
        $question->set_active(false);
        $app['dao.question']->save($question);

        $next_question = $app['dao.question']->find_by_order($next_order);
        $next_question->set_active(true);
        $app['dao.question']->save($next_question);

        return $next_question->get_id();

    });

    // Question Page

    /*$app->get('/question/{question_id}', function($question_id) use ($app) {

        $question = $app['dao.question']->find($question_id);
        $answers = $app['dao.answer']->find_all_by_question($question_id);
        $votes = $app['dao.vote']->find_all_by_question($question_id);

        return $app['twig']->render('question.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'votes' => $votes
        ));

    });*/
    // Question details with votes

    $app->match('/question/{question_id}', function ($question_id, Request $request) use ($app) {

        $question = $app['dao.question']->find($question_id);
        $answers = $app['dao.answer']->find_all_by_question($question_id);
        $right_answer = $app['dao.question']->get_right_answer($question_id);
        $votes = $app['dao.vote']->find_all_by_question($question_id);

        foreach ($answers AS $answer) {
            $form_option_answers[$answer->get_id()] = $answer->get_text();
        }

        $user = $app['security']->getToken()->getUser();

        $voteFormView = null;
        $has_voted = 0;
        $is_right = 0;
        $user_vote_id = 0;

        if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {

            $has_voted = count($app['dao.vote']->find_all_by_question_and_user($question_id, $user->get_id()));

            if ($has_voted > 0) {

                $user_vote = $app['dao.vote']->find_all_by_question_and_user($question->get_id(), $user->get_id());

                if ($has_voted && $user_vote[0]->get_answer_id() == $right_answer) {
                    $is_right = 1;
                }

                $user_vote_id = (int)$user_vote[0]->get_answer_id();

            }

            // A user is fully authenticated : he can add and see votes

            $vote = new Vote();

            $vote->set_question($question);
            $vote->set_question_id($question_id);

            $vote->set_user($user);
            $vote->set_user_id($user->get_id());

            $voteForm = $app['form.factory']->create(new VoteType(), $form_option_answers);
            $voteForm->handleRequest($request);

            if ($voteForm->isSubmitted() && $voteForm->isValid()) {

                $vote->set_answer_id($voteForm->getViewData()['answer_id']);

                if ($app['dao.vote']->save($vote)) {
                    $app['session']->getFlashBag()->add('success', 'Votre vote a bien été enregistré');
                } else {
                    $app['session']->getFlashBag()->add('error', 'Un seul vote par question !');
                }

            }

            $voteFormView = $voteForm->createView();

        }

        $votes = $app['dao.vote']->find_all_by_question($question_id);
        $stats = $app['dao.question']->get_stats_by_question($question_id);

        $user_count = count($app['dao.user']->find_all());
        $vote_stats = array();

        foreach ($stats AS $vote_data) {
            $vote_stats[] = array('name' => $vote_data['answer_text'], 'data' => array(round($vote_data['votes'] / $user_count * 100)));
        }

        $vote_stats = json_encode($vote_stats);

        return $app['twig']->render('question.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'votes' => $votes,
            'voteForm' => $voteFormView,
            'has_voted' => $has_voted,
            'user_vote_id' => $user_vote_id,
            'right_answer' => $right_answer,
            'is_right' => $is_right,
            'vote_stats' => $vote_stats
            ));

    });

    // Question details with votes

    $app->match('/public', function (Request $request) use ($app) {

        $question = $app['dao.question']->find_current();
        $question_id = $question->get_id();
        $answers = $app['dao.answer']->find_all_by_question($question_id);
        $votes = $app['dao.vote']->find_all_by_question($question_id);

        foreach ($answers AS $answer) {
            $form_option_answers[$answer->get_id()] = $answer->get_text();
        }

        $user = $app['security']->getToken()->getUser();

        $voteFormView = null;
        $has_voted = false;

        if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {

            // A user is fully authenticated : he can add and see votes

            $vote = new Vote();

            $vote->set_question($question);
            $vote->set_question_id($question_id);

            $vote->set_user($user);
            $vote->set_user_id($user->get_id());

            $voteForm = $app['form.factory']->create(new VoteType(), $form_option_answers);
            $voteForm->handleRequest($request);

            if ($voteForm->isSubmitted() && $voteForm->isValid()) {

                $vote->set_answer_id($voteForm->getViewData()['answer_id']);

                if ($app['dao.vote']->save($vote)) {
                    $app['session']->getFlashBag()->add('success', 'Votre vote a bien été enregistré');
                } else {
                    $app['session']->getFlashBag()->add('error', 'Un seul vote par question !');
                }


            }

            $voteFormView = $voteForm->createView();

            $has_voted = (boolean)count($app['dao.vote']->find_all_by_question_and_user($question_id, $user->get_id()));

        }

        $votes = $app['dao.vote']->find_all_by_question($question_id);

        $user_count = count($app['dao.user']->find_all());

        return $app['twig']->render('public.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'votes' => $votes,
            'voteForm' => $voteFormView,
            'has_voted' => $has_voted
            ));

    });
    // Question details with votes

    $app->match('/main', function (Request $request) use ($app) {

        $question = $app['dao.question']->find_current();
        $question_id = $question->get_id();

        $answers = $app['dao.answer']->find_all_by_question($question_id);
        $votes = $app['dao.vote']->find_all_by_question($question_id);

        foreach ($answers AS $answer) {
            $form_option_answers[$answer->get_id()] = $answer->get_text();
        }

        $user = $app['security']->getToken()->getUser();

        $voteFormView = null;
        $has_voted = false;

        if ($app['security']->isGranted('IS_AUTHENTICATED_FULLY')) {

            // A user is fully authenticated : he can add and see votes

            $vote = new Vote();

            $vote->set_question($question);
            $vote->set_question_id($question_id);

            $vote->set_user($user);
            $vote->set_user_id($user->get_id());

            $voteForm = $app['form.factory']->create(new VoteType(), $form_option_answers);
            $voteForm->handleRequest($request);

            if ($voteForm->isSubmitted() && $voteForm->isValid()) {

                $vote->set_answer_id($voteForm->getViewData()['answer_id']);

                if ($app['dao.vote']->save($vote)) {
                    $app['session']->getFlashBag()->add('success', 'Votre vote a bien été enregistré');
                } else {
                    $app['session']->getFlashBag()->add('error', 'Un seul vote par question !');
                }


            }

            $voteFormView = $voteForm->createView();

            $has_voted = (boolean)count($app['dao.vote']->find_all_by_question_and_user($question_id, $user->get_id()));

        }

        $votes = $app['dao.vote']->find_all_by_question($question_id);
        $stats = $app['dao.question']->get_stats_by_question($question_id);

        $user_count = count($app['dao.user']->find_all());
        $vote_stats = array();

        foreach ($stats AS $vote_data) {
            $vote_stats[] = array('name' => $vote_data['answer_text'], 'data' => array($vote_data['votes'] / $user_count * 100));
        }

        $vote_stats = json_encode($vote_stats);

        return $app['twig']->render('main.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'votes' => $votes,
            'voteForm' => $voteFormView,
            'has_voted' => $has_voted,
            'vote_stats' => $vote_stats
            ));

    });

    // Login Page

    $app->get('/login', function(Request $request) use ($app) {

        return $app['twig']->render('login.html.twig', array(
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));

    })->bind('login');  // named route so that path('login') works in Twig templates

    // Admin home page

    $app->get('/admin', function() use ($app) {

        $games = $app['dao.game']->find_all();
        $questions = $app['dao.question']->find_all();
        $answers = $app['dao.answer']->find_all();
        $votes = $app['dao.vote']->find_all();
        $users = $app['dao.user']->find_all();

        return $app['twig']->render('admin.html.twig', array(
            'games' => $games,
            'questions' => $questions,
            'answers' => $answers,
            'votes' => $votes,
            'users' => $users
        ));
    });

    // Add a new game

    $app->match('/admin/game/add', function(Request $request) use ($app) {

        $game = new Game();
        $gameForm = $app['form.factory']->create(new GameType(), $game);
        $gameForm->handleRequest($request);

        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $app['dao.game']->save($game);
            $app['session']->getFlashBag()->add('success', 'The game was successfully created.');
        }

        return $app['twig']->render('game_form.html.twig', array(
            'title' => 'New game',
            'gameForm' => $gameForm->createView()));

    });

    // Edit an existing game

    $app->match('/admin/game/{id}/edit', function($id, Request $request) use ($app) {

        $game = $app['dao.game']->find($id);
        $gameForm = $app['form.factory']->create(new GameType(), $game);
        $gameForm->handleRequest($request);

        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $app['dao.game']->save($game);
            $app['session']->getFlashBag()->add('success', 'The game was succesfully updated.');
        }

        return $app['twig']->render('game_form.html.twig', array(
            'title' => 'Edit game',
            'gameForm' => $gameForm->createView()));

    });

    // Remove a game

    $app->get('/admin/game/{id}/delete', function($id, Request $request) use ($app) {

        // Delete all associated comments

        $app['dao.question']->delete_all_by_game($id);

        // Delete the game

        $app['dao.game']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The game was succesfully removed.');

        return $app->redirect('/admin');

    });

    // Add a user

    $app->match('/admin/user/add', function(Request $request) use ($app) {

        $user = new User();
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            // generate a random salt value

            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();

            // find the default encoder

            $encoder = $app['security.encoder.digest'];

            // compute the encoded password

            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);

            $app['dao.user']->save($user);

            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');

        }

        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'New user',
            'userForm' => $userForm->createView()));

    });

    // Edit an existing user

    $app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {

        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $plainPassword = $user->getPassword();

            // find the encoder for the user

            $encoder = $app['security.encoder_factory']->getEncoder($user);

            // compute the encoded password

            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);

            $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');

        }

        return $app['twig']->render('user_form.html.twig', array(
            'title' => 'Edit user',
            'userForm' => $userForm->createView()));

    });

    // Remove a user

    $app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {

        // Delete all associated comments

        $app['dao.vote']->delete_all_by_user($id);

        // Delete the user

        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');

        return $app->redirect('/admin');

    });

    // Add a new question

    $app->match('/admin/question/add', function(Request $request) use ($app) {

        $question = new Question();
        $questionForm = $app['form.factory']->create(new QuestionType(), $question);
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {

            $question = $questionForm->getNormData();

            $app['dao.question']->save($question);
            $app['session']->getFlashBag()->add('success', 'The question was successfully created.');

        }

        return $app['twig']->render('question_form.html.twig', array(
            'title' => 'New question',
            'questionForm' => $questionForm->createView()));

    });

    // Edit an existing question

    $app->match('/admin/question/{id}/edit', function($id, Request $request) use ($app) {

        $question = $app['dao.question']->find($id);
        $questionForm = $app['form.factory']->create(new QuestionType(), $question);
        $questionForm->handleRequest($request);

        if ($questionForm->isSubmitted() && $questionForm->isValid()) {
            $app['dao.question']->save($question);
            $app['session']->getFlashBag()->add('success', 'The question was succesfully updated.');
        }

        return $app['twig']->render('question_form.html.twig', array(
            'title' => 'Edit question',
            'questionForm' => $questionForm->createView()));

    });

    // Remove a question

    $app->get('/admin/question/{id}/delete', function($id, Request $request) use ($app) {

        // Delete all associated answers and votes

        $app['dao.answer']->delete_all_by_question($id);
        $app['dao.vote']->delete_all_by_question($id);

        // Delete the question

        $app['dao.question']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The question was succesfully removed.');

        return $app->redirect('/admin');

    });

    // Add a new answer

    $app->match('/admin/answer/add', function(Request $request) use ($app) {

        $questions = $app['dao.question']->find_all();

        $questions_list = array();

        foreach ($questions AS $value) {
            $questions_list[$value->get_id()] = $value->get_text();
        }

        $answer = new Answer();
        $answerForm = $app['form.factory']->create(new AnswerType(), $questions_list);
        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid()) {

            $answer_data = $answerForm->getNormData();
            $answer->set_question_id($answer_data['question_id']);
            $answer->set_text($answer_data['text']);
            $answer->set_right($answer_data['right']);
            $answer->set_active($answer_data['active']);


            $app['dao.answer']->save($answer);
            $app['session']->getFlashBag()->add('success', 'The answer was successfully created.');
        }

        return $app['twig']->render('answer_form.html.twig', array(
            'title' => 'New answer',
            'answerForm' => $answerForm->createView()));

    });

    // Edit an existing answer

    $app->match('/admin/answer/{id}/edit', function($id, Request $request) use ($app) {

        $answer = $app['dao.answer']->find($id);
        $questions = $app['dao.question']->find_all();

        $questions_list = array();

        foreach ($questions AS $value) {
            $questions_list[$value->get_id()] = $value->get_text();
        }

        $answer->set_questions_list($questions_list);

        $answerForm = $app['form.factory']->create(new AnswerType(), $answer);

        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid()) {
            $app['dao.answer']->save($answer);
            $app['session']->getFlashBag()->add('success', 'The answer was succesfully updated.');
        }

        return $app['twig']->render('answer_form.html.twig', array(
            'title' => 'Edit answer',
            'answerForm' => $answerForm->createView(),
            'questions_list' => $questions_list
            ));

    });

    // Remove an answer

    $app->get('/admin/answer/{id}/delete', function($id, Request $request) use ($app) {

        // Delete all associated answers

        $app['dao.vote']->delete_all_by_answer($id);

        // Delete the answer

        $app['dao.answer']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The answer was succesfully removed.');

        return $app->redirect('/admin');

    });
