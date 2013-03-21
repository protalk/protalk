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

class ExploreControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData'
            )
        );
    }


    public function testGetExplorePageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/explore');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("href=\"/category/php\"", $response->getContent());
        $this->assertContains("href=\"/tag/phpnw\"", $response->getContent());
        $this->assertContains("href=\"http://localhost/search/speaker/1\"", $response->getContent());
    }

    public function testPerformSearchReturnsValidResults()
    {
        $client = static::createClient();

        $client->request('GET', '/result');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        // Assert the page contains the search form
        $this->assertContains("<form method='post' action='/result' id=\"searchForm\">", $response->getContent());
        // Assert the page contains a link to a video
        $this->assertContains('/my-video-about-php', $response->getContent());
        // Assert page contains links to categories and tags
        $this->assertContains('/category/php', $response->getContent());
        $this->assertContains('/tag/phpnw', $response->getContent());
    }

    public function testPerformInvalidSearchReturnsError()
    {
        $client = static::createClient();

        $client->request('GET', '/result/date/abc123');

        $response = $client->getResponse();

        $this->assertEquals(403, $response->getStatusCode());
    }
}
