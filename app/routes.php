<?php

    // Game page

    $app->get('/', function() use ($app) {

        $question = $app['dao.question']->find_current();

        $answers = $app['dao.answer']->find_current_answer($question->get_id());
        $games = $app['dao.game']->find_all();
        $users = $app['dao.user']->find_all();
        $votes = $app['dao.vote']->find_all();

        ob_start();             // start buffering HTML output
        require '../views/view.php';
        $view = ob_get_clean(); // assign HTML output to $view

        return $view;

    });
