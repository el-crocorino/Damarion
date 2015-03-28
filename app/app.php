<?php

    use Symfony\Component\Debug\ErrorHandler;
    use Symfony\Component\Debug\ExceptionHandler;

    // Register global error and exception handlers

    ErrorHandler::register();
    ExceptionHandler::register();

    // Register service providers.

    $app->register(new Silex\Provider\DoctrineServiceProvider());

    // Register services.

    $app['dao.answer'] = $app->share(function ($app) {
        return new Damarion\DAO\AnswerDAO($app['db']);
    });

    $app['dao.game'] = $app->share(function ($app) {
        return new Damarion\DAO\GameDAO($app['db']);
    });

    $app['dao.question'] = $app->share(function ($app) {
        return new Damarion\DAO\QuestionDAO($app['db']);
    });

    $app['dao.user'] = $app->share(function ($app) {
        return new Damarion\DAO\UserDAO($app['db']);
    });

    $app['dao.vote'] = $app->share(function ($app) {
        return new Damarion\DAO\VoteDAO($app['db']);
    });
