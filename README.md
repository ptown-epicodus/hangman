# Hangman

#### Website for playing Hangman for Epicodus, 02.09.2017

#### By Patrick McGreevy & David Quisenberry

## Description

This website allows the user to play [Hangman](https://en.wikipedia.org/wiki/Hangman_(game)).


## Setup/Installation Requirements
1. Set project root as working directory in CLI.
2. Run `$ composer install --prefer-source --no-interaction`.
3. Run `$ cd web`.
4. Run `$ php -S localhost:8000`.
5. Visit **`localhost:8000`** in web browser.


## Technologies Used

HTML

CSS

Bootstrap

PHP

Silex

Twig

Composer

JSON

## Specs
* A player can start a game, causing a word to be generated, showing a row of blanks representing each letter.
* A player can guess the word and get feedback on whether he is correct.
* A player can guess a letter and get feedback on whether the letter appears in the word.
* The game does not accept a duplicate letter guess.
* A correct letter guess reveals all the occurrences of that letter in place of the appropriate blank(s).
* An incorrect guess displays a component of the 'hangman' and decrements by one the number of guesses the player can make.
* An incorrect letter guess adds that letter to the display of letters not present in the word.
* The player wins the game when he guess the word correctly and loses when he has reached the limit of incorrect guesses.
* The player can start a new game when the previous one concludes.


## Known Bugs

_No known bugs or issues_

### License

Copyright (c) 2017 _**Patrick McGreevy**_ & _**David Quisenberry**_

This software is licensed under the MIT license.
