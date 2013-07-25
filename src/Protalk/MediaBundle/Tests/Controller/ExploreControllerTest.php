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

    public function testPaginationSummaryShowsCorrectResults()
    {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/tag/quality-assurance');
        $response = $client->getResponse();

        // Gets the number of results from the pagination results summary
        $numResults  = (int) $crawler->filter('#resultHeading > h1 > span.hilite')->text();
        // Gets the number of Media elements
        $numElements = $crawler->filter('article.mediaLarge')->count();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("You have searched for 'quality-assurance'", $response->getContent());
        $this->assertEquals($numElements, $numResults);
    }

    public function testGetCategoryPageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/category/tools');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetSpeakerPageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/search/speaker/frank');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetSpeakerPageWithPageParameterReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/search/speaker/frank?page=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
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

    public function invalidParamUrls()
    {
        return array(
            array('/tag/quality-assurance/invalid/desc'),
            array('/tag/quality-assurance/date/invalid'),
            array('/result/date/abc123'),
            array('/result/php/invalid/desc'),
            array('/result/php/date/invalid'),
            array('/category/tools/invalid/desc'),
            array('/category/tools/date/invalid'),
            array('/search/speaker/frank?sort=invalid'),
            array('/search/speaker/frank?order=invalid'),
        );
    }

    /**
     * @dataProvider invalidParamUrls
     */
    public function testPerformRequestWithInvalidParams($url)
    {
        $client = static::createClient();

        $client->request('GET', $url);

        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}
