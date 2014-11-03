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

class HomeControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\DataFixtures\ORM\MediaData'
            )
        );
    }


    public function testGetFeedReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request('GET', '/feed');

        $response = $client->getResponse();
        $content = $client->getResponse()->getContent();

        // Assertions on the channel
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('<title>ProTalk RSS feed</title>', $content);
        $this->assertContains(
            '<atom:link href="http://protalk.me/feed/" rel="self" type="application/rss+xml" />',
            $content
        );
        $this->assertContains('<link>http://protalk.me</link>', $content);

        // Assertions on the items in the feed
        $this->assertContains('<title>Your code sucks, let&#039;s fix it</title>', $content);
        $this->assertContains('<link>http://protalk.me/your-code-sucks-lets-fix-it</link>', $content);

        $this->assertContains('<dc:creator>ProTalk</dc:creator>', $content);
        $this->assertContains('<guid isPermaLink="false">http://protalk.me/your-code-sucks-lets-fix-it</guid>', $content);
        $this->assertContains('<p>Identify trouble areas in your code, learn how to refactor them and train you to write better code in future projects avoiding common pitfalls.</p>', $content);
    }
}
