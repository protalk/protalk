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

class HomeControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData'
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
        $this->assertContains('<title>Tool Up Your Lamp Stack</title>', $content);
        $this->assertContains('<link>http://protalk.me/tool-up-your-lamp-stack</link>', $content);

        $today = new \DateTime();
        $today = $today->format('d-m-Y');
        
        $this->assertContains('<pubDate>'.$today.'</pubDate>', $content);
        $this->assertContains('<dc:creator>ProTalk</dc:creator>', $content);
        $this->assertContains('<guid isPermaLink="false">http://protalk.me/tool-up-your-lamp-stack</guid>', $content);
        $this->assertContains('<p>A talk about peripheral tools that aid web development</p>', $content);
    }
}
