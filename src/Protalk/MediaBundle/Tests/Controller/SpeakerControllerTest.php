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
use Protalk\MediaBundle\Controller\SpeakerController;

class SpeakerControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            array(
                'Protalk\MediaBundle\DataFixtures\ORM\SpeakerData'
            )
        );
    }

    public function testGetSingleSpeakerReturnsValidResponse()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/speaker/cal-evans/1',
            array(),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Cal Evans', $response->getContent(), 'Name was not set correctly!');
        $this->assertContains("Bio of Mr. Cal Evans", $response->getContent(), 'Bio was not set correctly!');
    }

    public function testGetSpeakerReturnsNotFoundWithInvalidRequest()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/speaker/rafael-dohms/999',
            array(),
            array(),
            array(
                'HTTP_X-Requested-With' => 'XMLHttpRequest',
            )
        );

        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGetSpeakerReturns500IfNotAjax()
    {
        // Tests that the action throws an exception if the request is not an AJAX request
        $client = static::createClient();

        $client->request('GET', '/speaker/rafael-dohms/1');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}
