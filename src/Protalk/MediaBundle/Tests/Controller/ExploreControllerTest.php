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

class ExploreControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\DataFixtures\ORM\MediaData',
                'Protalk\MediaBundle\DataFixtures\ORM\MediatypeData',
                'Protalk\MediaBundle\DataFixtures\ORM\TagData',
                'Protalk\MediaBundle\DataFixtures\ORM\CategoryData',
                'Protalk\MediaBundle\DataFixtures\ORM\LanguageData',
                'Protalk\MediaBundle\DataFixtures\ORM\SpeakerData',
            )
        );
    }

    public function testPaginationSummaryShowsCorrectResults()
    {
        $client = static::createClient();

        $crawler  = $client->request('GET', '/tag/refactoring');
        $response = $client->getResponse();

        // Gets the number of results from the pagination results summary
        $numResults  = (int) $crawler->filter('#resultHeading > h1 > span.hilite')->text();
        // Gets the number of Media elements
        $numElements = $crawler->filter('article.mediaLarge')->count();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("You have searched for 'refactoring'", $response->getContent());
        $this->assertEquals($numElements, $numResults);
    }

    public function testGetCategoryPageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/category/design-patterns');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetSpeakerPageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/search/speaker/cal');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetSpeakerPageWithPageParameterReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/search/speaker/cal?page=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetExplorePageReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/explore');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains("href=\"/category/design-patterns\"", $response->getContent());
        $this->assertContains("href=\"/tag/refactoring\"", $response->getContent());
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
        $this->assertContains('/your-code-sucks-lets-fix-it', $response->getContent());
        // Assert page contains links to categories and tags
        $this->assertContains('/category/design-patterns', $response->getContent());
        $this->assertContains('/tag/refactoring', $response->getContent());

        $client->request(
            'GET',
            '/result/php/rating/asc?page=1'
        );

        $response = $client->getResponse();

        $this->assertContains("You have searched for 'php'", $response->getContent());
        $this->assertContains('data-url="/result/php/rating/asc?page=1"        selected="selected">Sort by rating (asc)</option>', $response->getContent());
    }

    public function invalidParamUrls()
    {
        return array(
            array('/tag/refactoring/invalid/desc'),
            array('/tag/refactoring/date/invalid'),
            array('/result/date/abc123'),
            array('/result/php/invalid/desc'),
            array('/result/php/date/invalid'),
            array('/category/design-patterns/invalid/desc'),
            array('/category/design-patterns/date/invalid'),
            array('/search/speaker/cal?sort=invalid'),
            array('/search/speaker/cal?order=invalid'),
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
