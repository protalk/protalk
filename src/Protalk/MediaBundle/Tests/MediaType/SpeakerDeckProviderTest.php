<?php

namespace Protalk\MediaBundle\Tests\MediaType;

use Protalk\MediaBundle\MediaType\SpeakerDeckProvider;

class SpeakerDeckProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var SpeakerDeckProvider */
    private $provider;

    public function setUp()
    {
        $this->provider = new SpeakerDeckProvider();
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
            array('https://speakerdeck.com/jmather/short-intro-to-design-patterns', true),
            array('http://www.gizmodo.com', false),
            array('http://vimeo.com/', false),
            array('http://player.vimeo.com/video/54691719', false),
        );
    }

    public function testRenderer()
    {
        $url = 'http://www.example.com';
        $expected = '<html>test</html>';

        $twig = $this->getMock('Twig_Environment');
        $twig->expects($this->once())
            ->method('render')
            ->will($this->returnValue($expected));

        $this->provider->render($url, $twig);
    }
}