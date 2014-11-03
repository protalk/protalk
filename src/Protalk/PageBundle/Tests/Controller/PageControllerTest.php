<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\PageBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\PageBundle\DataFixtures\ORM\PageData'
            )
        );
    }
    public function testGetHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetPageWithInvalidRequest()
    {
        $client = static::createClient();

        $client->request('GET', '/page/madeUpPage');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testGetPageWithValidRequest()
    {
        $client = static::createClient();

        $client->request('GET', '/page/about');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('<h1>About</h1>', $client->getResponse()->getContent());
        $this->assertContains('ProTalk is the brain child of Kim Rowan and Lineke Kerckhoffs-Willems.', $client->getResponse()->getContent());
    }
}
