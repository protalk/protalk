<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ProTalk\PageBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Protalk\MediaBundle\Controller\MediaController;

class MediaControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData'
            )
        );
    }

    public function testMediaPageShowsAllData()
    {
        $client = static::createClient();

        $client->request('GET', '/my-video-about-php');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertContains("My video about PHP", $response->getContent());
        $this->assertContains("PHPNW", $response->getContent());
        $this->assertContains("Joe Bloggs", $response->getContent());
        $this->assertContains("A video about PHP!", $response->getContent());
        $this->assertContains("http://some.video-url.com", $response->getContent());
        $this->assertContains("20:00:00", $response->getContent());
    }

    public function testMediaPageIncrementsMediaViewCount()
    {
        $client = static::createClient();

        $client->request('GET', '/my-video-about-php');
        $response = $client->getResponse();

        $this->assertContains("101 views", $response->getContent());

        $client->request('GET', '/my-video-about-php');
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
}
