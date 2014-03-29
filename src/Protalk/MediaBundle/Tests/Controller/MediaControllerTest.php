<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class MediaControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\DataFixtures\ORM\MediaData'
            )
        );
    }

    public function testMediaPageShowsAllData()
    {
        $client = static::createClient();

        $client->request('GET', '/interview-with-lineke-kerckhoffs-willems');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertContains("Interview with Lineke Kerckhoffs-Willems", $response->getContent());
        $this->assertContains("Cal Evans", $response->getContent());
        $this->assertContains("A Voices of the Elephpant Interview with Lineke Kerckhoffs-Willems by Cal Evans", $response->getContent());
        $this->assertContains("http://voices.of.the.elephpant.s3.amazonaws.com/vote_061.mp3", $response->getContent());
        $this->assertContains("14:21", $response->getContent());
    }

    public function testMediaPageDoesNotIncrementsMediaViewCountAfterFirstVisit()
    {
        $client = static::createClient();

        $client->request('GET', '/your-code-sucks-lets-fix-it');
        $response = $client->getResponse();

        $this->assertContains("8895 views", $response->getContent());

        $client->request('GET', '/your-code-sucks-lets-fix-it');
        $response = $client->getResponse();

        $this->assertContains("8895 views", $response->getContent());
    }

    public function testGetMediaThatDoesNotExistThrows404()
    {
        $client = static::createClient();

        $client->request('GET', '/my-made-up-video');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetSpeakersForMediaReturnsValidSpeaker()
    {
        $client = static::createClient();

        $client->request('GET', '/media/speakers/your-code-sucks-lets-fix-it');
        $content = $client->getResponse()->getContent();

        $this->assertContains("Rafael Dohms", $content);
        $this->assertContains("Computer Engineer, PHP Evangelist and Gamer. Enabler of the AmsterdamPHP Community. Loves code and growing communities.", $content);
    }

    public function testGetSpeakersForMediaWithInvalidSlugReturnsError()
    {
        $client = static::createClient();

        $client->request('GET', '/media/speakers/symfony-for-dummies');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testGetInvalidSpeakersForMediaReturns404()
    {
        $client = static::createClient();

        $client->request('GET', '/media/999/speakers');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testSetRatingReturnsValidResponseWithValidRequest()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/rate/1/3',
            array(),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );

        $response = $client->getResponse();

        $stars = substr_count($response->getContent(), 'star_full.png');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(3, $stars);
    }

    public function testSetRatingReturnsNotFoundWithInvalidRequest()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/rate/999/3',
            array(),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testSetRatingReturns500IfNotAjax()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/rate/1/3'
        );

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}
