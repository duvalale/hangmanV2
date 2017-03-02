<?php

namespace Tests\AppBundle\Game;

use AppBundle\Game\Game;

class GameTest extends \PHPUnit_Framework_Testcase
{
    /**
     * checks that game values are correctly initialized
     */
    public function testInitialValues()
    {
        $game = new Game('php');

        $this->assertSame(11, $game->getRemainingAttempts());
        $this->assertEmpty($game->getFoundLetters());
        $this->assertEmpty($game->getTriedLetters());
        $this->assertSame(array('p', 'h', 'p'), $game->getWordLetters());
        $this->assertFalse($game->isHanged());
        $this->assertFalse($game->isOver());
        $this->assertFalse($game->isWon());
        $this->assertFalse($game->isLetterFound('p'));
        $this->assertFalse($game->isLetterFound('h'));
    }

    /**
     * checks that a played letter is registered correctly
     */
    public function testPlayedGame() {
        $game = new Game('anaconda');

        $game->tryLetter('a');
        $this->assertTrue($game->isLetterFound('a'));
        $this->assertSame(array('a'), $game->getFoundLetters());

        $game->tryLetter('c');
        $this->assertFalse($game->isLetterFound('b'));
        $this->assertSame(array('a', 'c'), $game->getTriedLetters());
    }


    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The letter "!" is not a valid ASCII character matching [a-z].
     */
    public function testWrongLetter() {
        $game = new Game('poop');

        $game->tryLetter('!');
    }

    /**
     * Checks the correct word wins the game and the false word does not win
     * @dataProvider providerWords
     */
    public function testWords($word, $expectedResult) {
        $game = new Game('poop');

        $game->tryWord($word);

        $this->assertSame($expectedResult, $game->isWon());
    }

    public function providerWords()
    {
        return array(
            'correctWord' => array('poop', true),
            'incorrectWord' => array('php', false)
        );
    }
}