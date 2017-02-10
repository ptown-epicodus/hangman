<?php
    class Game
    {
        private $word;
        private $guess_count;
        private $incorrect_letters;
        private $guesses;
        private $letter_positions;
        private $won;
        private $recent_guess;

        function __construct()
        {
            $this->word = str_split('hello');
            $this->guess_count = 6;
            $this->incorrect_letters = array();
            $this->guesses = array();
            $this->letter_positions = array_fill(0, count($this->word), '-');
            $this->won = false;
            $this->recent_guess = NULL;
        }

        function getWord()
        {
            return $this->word;
        }

        function getWordString()
        {
            return implode($this->word);
        }

        function getGuessCount()
        {
            return $this->guess_count;
        }

        function decrementGuessCount()
        {
            $this->guess_count--;
        }

        function getIncorrectLetters()
        {
            return $this->incorrect_letters;
        }

        function addIncorrectLetter($new_letter)
        {
            if (! in_array($new_letter, $this->incorrect_letters)) {
                array_push($this->incorrect_letters, $new_letter);
                return true;
            } else {
                return false;
            }
        }

        function getGuesses()
        {
            return $this->guesses;
        }

        function addGuess($new_guess)
        {
            array_push($this->guesses, $new_guess);
        }

        function checkGuesses($letter)
        {
            foreach ($this->guesses as $guess) {
                if ($guess->getLetter() == $letter) {
                    return false;
                }
            }

            return true;
        }

        function guessIsAccurate($guess)
        {
            $result = array();
            for ($i = 0; $i < count($this->word); $i++) {
                if ($this->word[$i] == $guess->getLetter()) {
                    array_push($result, $i);
                }
            }

            if (empty($result)) {
                $guess_is_unique =  $this->addIncorrectLetter($guess->getLetter());
                if ($guess_is_unique) {
                    $this->decrementGuessCount();
                }
            }
            return $result;
        }

        function getLetterPositions()
        {
            return $this->letter_positions;
        }

        function getLetterPositionsString()
        {
            return implode($this->letter_positions);
        }

        function updateLetterPositions($letter, $indices)
        {
            if ( ! empty($indices)) {
                for ($i = 0; $i < count($indices); $i++) {
                    $this->letter_positions[$indices[$i]] = $letter;
                }
            }
        }

        function getWon()
        {
            return $this->won;
        }

        function win()
        {
            $this->won = true;
        }

        function getRecentGuess()
        {
            return $this->recent_guess;
        }

        function setRecentGuess($new_guess)
        {
            $this->recent_guess = $new_guess;
        }

        function save()
        {
            $_SESSION['game'] = $this;
        }

        function delete()
        {
            $_SESSION['game'] = NULL;
        }

        static function getGame()
        {
            return $_SESSION['game'];
        }
    }
?>
