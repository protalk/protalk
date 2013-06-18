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
use Protalk\MediaBundle\Controller\ExploreController;

class ExploreControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaTagData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadTagData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaLanguageCategoryData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadCategoryData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaSpeakerData',
                'Protalk\MediaBundle\Tests\Fixtures\LoadSpeakerData',
            )
        );
    }

    public function testGetExplorePageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/explore');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("href=\"/category/tools\"", $response->getContent());
        $this->assertContains("href=\"/tag/quality-assurance\"", $response->getContent());
        $this->assertContains("href=\"http://localhost/search/speaker/4\"", $response->getContent());
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
        $this->assertContains('/phpbb4-building-end-user-applications-with-symfony2', $response->getContent());
        // Assert page contains links to categories and tags
        $this->assertContains('/category/tools', $response->getContent());
        $this->assertContains('/tag/quality-assurance', $response->getContent());

        $client->request(
            'GET',
            '/result/video/rating/asc?page=1'
        );

        $response = $client->getResponse();

        $this->assertContains("You have searched for 'video'", $response->getContent());
        $this->assertContains('data-url="/result/video/rating/asc?page=1"        selected="selected">Sort by rating (asc)</option>', $response->getContent());
    }

    public function testPerformInvalidSearchReturnsError()
    {
        $client = static::createClient();

        $client->request('GET', '/result/date/abc123');

        $response = $client->getResponse();

        $this->assertEquals(403, $response->getStatusCode());
    }
}
