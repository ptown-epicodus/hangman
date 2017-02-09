<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../src/Game.php';
    require_once __DIR__ . '/../src/Guess.php';

    session_start();

    if (empty($_SESSION['game'])) {
        $_SESSION['game'] = NULL;
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__ . '/../views/'
    ));

    $app->get('/', function() use ($app) {
        return $app->redirect('/hangman');
    });

    $app->get('/hangman', function() use ($app) {
        return $app['twig']->render('hangman.html.twig', array(
            'game' => Game::getGame()
        ));
    });

    $app->post('new_game', function() use ($app) {
        $game = new Game();
        $game->save();

        return $app->redirect('/hangman');
    });


    return $app;
?>
