<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function providerWords()
    {
        yield['anaconda', 'Yeah! You won this game!'];
        yield['pizza', 'Oops, you lost this game!'];
    }


    /**
     * @param $word
     * @param $expectedH2
     * @dataProvider providerWords
     */
    public function testIndex($word, $expectedH2)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        //check we're on home page with 200 status code
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //Go on game page
        $link = $crawler->selectLink('Game')->link();
        $crawler = $client->click($link);
        //check we reached the game page successfully
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //enter a word in try word form
        $form = $crawler->selectButton('Let me guess...')->form();
        $client->submit($form, ['word' => $word]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        //get what is displayed as h2 after redirection
        $h2 = $crawler->filter("#content h2")->text();
        $this->assertSame($expectedH2, $h2);
    }
}
