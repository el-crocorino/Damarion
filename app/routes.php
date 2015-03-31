<?php

    use Symfony\Component\HttpFoundation\Request;
    use Damarion\Domain\Vote;
    use Damarion\Form\Type\VoteType;

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

        $rawPassword = '<?admin?>';
        $salt = '%qUgq3NAYfC1MKwrW?yevbE';
        $encoder = $app['security.encoder.digest'];

        return $encoder->encodePassword($rawPassword, $salt);

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

        return $app['twig']->render('question.html.twig', array(
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
