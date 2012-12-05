<?php

namespace Protalk\MediaBundle\Tests\MediaType;

use Protalk\MediaBundle\MediaType\YouTubeProvider;

class YouTubeProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var YouTubeProvider */
    private $provider;

    public function setUp()
    {
        $this->provider = new YouTubeProvider();
    }

    /**
     * @dataProvider urlProvider
     */
    public function testThatProviderPicksUpValidUrls($url, $expected)
    {
        $actual = $this->provider->supports($url);
        $this->assertEquals($expected, $actual);
    }

    public function urlProvider()
    {
        return array(
            array('http://m.youtube.com/watch?v=293894', true),
            array('http://www.gizmodo.com', false),
            array('http://www.youtube.com/', false),
            array('http://www.youtube.com/watch?v=123', true),
        );
    }
}
