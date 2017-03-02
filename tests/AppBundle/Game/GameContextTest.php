<?php
/**
 * Created by PhpStorm.
 * User: alexandraduval
 * Date: 02/03/2017
 * Time: 11:31
 */


 namespace Tests\AppBundle\Game;

 use AppBundle\Game\Game;
 use AppBundle\Game\GameContext;
 use Symfony\Component\HttpFoundation\Session\SessionInterface;

 class GameContextTest extends \PHPUnit_Framework_TestCase
 {
    private $session;
    private $gameContext;

    protected function setUp()
    {
        $this->session = $this->prophesize(SessionInterface::class);
        $this->gameContext = new GameContext($this->session->reveal());
    }

    public function testLoadGameWithEmptySession()
    {
        $this->session->get('hangman')->willReturn(false);
        $game = $this->gameContext->loadGame();

        $this->assertFalse($game);
    }

     public function testLoadGameWithSession()
     {
         $this->session->get('hangman')->willReturn([
             'word'          => 'pizza',
             'attempts'      => 11,
             'found_letters' => array('a'),
             'tried_letters' => array('a')
         ]);
         $game = $this->gameContext->loadGame();

         $this->assertInstanceOf(Game::class, $game);
     }
 }