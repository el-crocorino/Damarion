<?php

    use Symfony\Component\Debug\ErrorHandler;
    use Symfony\Component\Debug\ExceptionHandler;

    // Register global error and exception handlers

    ErrorHandler::register();
    ExceptionHandler::register();

    // Register service providers.

    $app->register(new Silex\Provider\DoctrineServiceProvider());

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
        $twig->addExtension(new Twig_Extensions_Extension_Text());
        return $twig;
    }));

    $app->register(new Silex\Provider\ValidatorServiceProvider());
    $app->register(new Silex\Provider\SessionServiceProvider());
    $app->register(new Silex\Provider\UrlGeneratorServiceProvider());
    $app->register(new Silex\Provider\SecurityServiceProvider(), array(
        'security.firewalls' => array(
            'secured' => array(
                'pattern' => '^/',
                'anonymous' => true,
                'logout' => true,
                'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
                'users' => $app->share(function () use ($app) {
                    return new Damarion\DAO\UserDAO($app['db']);
                }),
            ),
        ),
        'security.role_hierarchy' => array(
            'ROLE_ADMIN' => array('ROLE_USER')
        ),
        'security.access_rules' => array(
            array('^/admin', 'ROLE_ADMIN')
        )
    ));
    $app->register(new Silex\Provider\FormServiceProvider());
    $app->register(new Silex\Provider\TranslationServiceProvider());

    // Register services.

    $app['dao.question'] = $app->share(function ($app) {
        return new Damarion\DAO\QuestionDAO($app['db']);
    });

    $app['dao.answer'] = $app->share(function ($app) {
        $answerDAO = new Damarion\DAO\AnswerDAO($app['db']);
        $answerDAO->set_question_DAO($app['dao.question']);
        return $answerDAO;
    });

    $app['dao.game'] = $app->share(function ($app) {
        return new Damarion\DAO\GameDAO($app['db']);
    });

    $app['dao.user'] = $app->share(function ($app) {
        return new Damarion\DAO\UserDAO($app['db']);
    });

    $app['dao.vote'] = $app->share(function ($app) {
        $voteDAO = new Damarion\DAO\VoteDAO($app['db']);
        $voteDAO->set_question_DAO($app['dao.question']);
        $voteDAO->set_user_DAO($app['dao.user']);
        $voteDAO->set_answer_DAO($app['dao.answer']);
        return $voteDAO;
    });
