<?php
    class Guess
    {
        private $letter;

        function __construct($letter)
        {
            $this->letter = $letter;
        }

        function getLetter()
        {
            return $this->letter;
        }
    }
?>
