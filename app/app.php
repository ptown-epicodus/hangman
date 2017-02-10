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
        $game = Game::getGame();
        $guess_just_made = NULL;
        if ($game) {
            $guess_just_made = $game->getRecentGuess();
        }

        if ($guess_just_made) {
            return $app['twig']->render('hangman.html.twig', array(
                'game' => $game,
                'correct' => ! empty($game->guessIsAccurate($guess_just_made))
            ));
        } else {
            return $app['twig']->render('hangman.html.twig', array(
                'game' => $game
            ));
        }
    });

    $app->post('/new_game', function() use ($app) {
        $game = new Game();
        $game->save();

        return $app->redirect('/hangman');
    });

    $app->post('/word_guess', function() use ($app) {
        $game = Game::getGame();
        $word = $_POST['word-guess'];

        if ($game->getWordString() == $word){
            $game->win();
        } else {
            $game->decrementGuessCount();
        }

        return $app->redirect('/hangman');
    });

    $app->post('/new_guess', function() use ($app) {
        $game = Game::getGame();
        $guess = new Guess($_POST['letter-guess']);
        $unique = $game->checkGuesses($guess->getLetter());
        if ($unique) {
            $game->addGuess($guess);
            $game->setRecentGuess($guess);
            $letters_found = $game->guessIsAccurate($guess);
            $game->updateLetterPositions($guess->getLetter(), $letters_found);
        } else {
            $game->setRecentGuess(NULL);
        }

        return $app->redirect('/hangman');
    });

    $app->post('/clear_game', function() use ($app) {
        $game = Game::getGame();
        $game->delete();

        return $app->redirect('/hangman');
    });


    return $app;
?>
