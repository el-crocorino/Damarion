<?php

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

    // Question Page

    $app->get('/question/{question_id}', function($question_id) use ($app) {

        $question = $app['dao.question']->find($question_id);
        $answers = $app['dao.answer']->find_all_by_question($question_id);
        $votes = $app['dao.vote']->find_all_by_question($question_id);

        return $app['twig']->render('question.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'votes' => $votes
        ));

    });

    // Login Page

    $app->get('/login', function(Request $request) use ($app) {

        return $app['twig']->render('login.html.twig', array(
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username'),
        ));

    })->bind('login');  // named route so that path('login') works in Twig templates
