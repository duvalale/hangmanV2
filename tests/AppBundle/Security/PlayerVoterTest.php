<?php

use \Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class PlayerVoterTest extends \PHPUnit_Framework_TestCase {
    protected $voter;

    protected function setUp()
    {
        $this->voter = new \AppBundle\Security\PlayerVoter();
    }

    public function provideTests()
    {
        $now = new \DateTime();

        yield [VoterInterface::ACCESS_GRANTED, (clone $now)->modify('-26 years')];
        yield [VoterInterface::ACCESS_DENIED, (clone $now)->modify('-16 years')];
    }

    /**
     * @dataProvider provideTests
     */
    public function testVote($expected, $birthdate)
    {
        $player = new \AppBundle\Entity\Player();
        $player->setBirthday($birthdate);

        $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($player, 'credentials', 'provider');

        $this->assertSame($expected, $this->voter->vote($token, null, ['PLAY_GAME']));
    }
}