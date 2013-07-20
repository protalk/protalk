<?php

namespace Protalk\ApiBundle\Tests\Helper;

use Protalk\ApiBundle\Helper\CMMIDataHelper;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CMMIDataHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpException
     * @expectedExceptionMessage Unable to generate CMMI Data, no mapping is known
     */
    public function testBuildArrayWithoutMapping()
    {
        $items = new \RecursiveArrayIterator();;

        $request = new Request();
        $cmmiDataHelper = new CMMIDataHelper($request);

        $cmmiDataHelper->buildArray($items);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\HttpException
     * @expectedExceptionMessage Cannot add resource, identifier not known in the iterator
     */
    public function testBuildArrayWithoutKnowIdentifier()
    {
        $items = new \RecursiveArrayIterator();

        $request = new Request(array(), array(), array(), array(), array(), array('HTTPS'=>0), null);

        $cmmiDataHelper = new CMMIDataHelper(
            $request,
            array(
                'identifier' => 'slug',
                'mapping' => array(
                    'title' => 'title',
                    'content' => 'content',
                )
            )
        );

        $cmmiDataHelper->buildArray($items);
    }

    public function testBuildArray()
    {
        $serverParams = array(
            'HTTPS' => 0,
            'SERVER_PORT' => 80,
            'SERVER_ADDR' => 'www.protalk.me',
            'REQUEST_URI' => '/api/speakers'
        );
        $request = new Request(array(), array(), array(), array(), array(), $serverParams, null);

        $cmmiDataHelper = new CMMIDataHelper(
            $request,
            array(
                'identifier' => 'id',
                'route' => 'speaker',
                'mapping' => array(
                    'name' => 'name',
                )
            )
        );

        $items = new \RecursiveArrayIterator(array(
            array(
                'id' => 7,
                'name' => 'Cal Evans',
                'mediaCount' => 4,
            ),
            array(
                'id' => 9,
                'name' => 'Chris Hartjes',
                'mediaCount' => 12,
            )
        ));

        $resultArray = $cmmiDataHelper->buildArray($items);

        $this->assertArrayHasKey('_links', $resultArray);
        $this->assertArrayHasKey('self', $resultArray['_links']);
        $this->assertArrayHasKey('href', $resultArray['_links']['self']);
        $this->assertSame('http://www.protalk.me/api/speakers', $resultArray['_links']['self']['href']);

        $this->assertArrayHasKey('_embedded', $resultArray);
        $this->assertArrayHasKey('speaker', $resultArray['_embedded']);
        $this->assertCount(2, $resultArray['_embedded']['speaker']);

        $this->assertArrayHasKey('name', $resultArray['_embedded']['speaker'][0]);
        $this->assertSame('Cal Evans', $resultArray['_embedded']['speaker'][0]['name']);

        $this->assertArrayHasKey('_links', $resultArray['_embedded']['speaker'][0]);
        $this->assertArrayHasKey('self', $resultArray['_embedded']['speaker'][0]['_links']);
        $this->assertArrayHasKey('href', $resultArray['_embedded']['speaker'][0]['_links']['self']);
        $this->assertSame('/speaker/7', $resultArray['_embedded']['speaker'][0]['_links']['self']['href']);
    }
}