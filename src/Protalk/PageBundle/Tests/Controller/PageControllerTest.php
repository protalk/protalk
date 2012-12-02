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
use Protalk\PageBundle\Controller\PageController;

class PageControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\PageBundle\Tests\Fixtures\LoadPageData'
            )
        );
    }
    public function testGetHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetPage()
    {
        $client = static::createClient();

        $client->request('GET', '/page/news');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<h1>News</h1>', $client->getResponse()->getContent());
        $this->assertContains('<p>Some news page content.</p>', $client->getResponse()->getContent());
    }
}
