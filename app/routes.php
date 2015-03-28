<?php

    // Game page

    $app->get('/', function() use ($app) {

        $question = $app['dao.question']->find_current();

        $answers = $app['dao.answer']->find_current_answer($question->get_id());
        $games = $app['dao.game']->find_all();
        $users = $app['dao.user']->find_all();
        $votes = $app['dao.vote']->find_all();

        return $app['twig']->render('index.html.twig', array(
            'question' => $question,
            'answers' => $answers,
            'games' => $games,
            'users' => $users,
            'votes' => $votes
        ));

    });
