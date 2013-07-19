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
use Protalk\MediaBundle\Controller\MediaController;

class MediaControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaSpeakerData'
            )
        );
    }

    public function testMediaPageShowsAllData()
    {
        $client = static::createClient();

        $client->request('GET', '/tool-up-your-lamp-stack');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertContains("Tool Up Your Lamp Stack", $response->getContent());
        $this->assertContains("Lorna Mitchell", $response->getContent());
        $this->assertContains("A talk about peripheral tools that aid web development", $response->getContent());
        $this->assertContains("http://vimeo.com/30012690/", $response->getContent());
        $this->assertContains("1hr 20mins", $response->getContent());
    }

    public function testMediaPageIncrementsMediaViewCount()
    {
        $client = static::createClient();

        $client->request('GET', '/tool-up-your-lamp-stack');
        $response = $client->getResponse();

        $this->assertContains("101 views", $response->getContent());

        $client->request('GET', '/tool-up-your-lamp-stack');
        $response = $client->getResponse();

        $this->assertContains("102 views", $response->getContent());
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

        $client->request('GET', '/media/speakers/phpbb4-building-end-user-applications-with-symfony2');
        $content = $client->getResponse()->getContent();

        $this->assertContains("Nils Adermann", $content);
        $this->assertContains("Nils Adermann&#039;s bio.", $content);
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
