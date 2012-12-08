<?php

namespace Protalk\MediaBundle\Tests\MediaType;

use Protalk\MediaBundle\MediaType\Manager;

class ManagerText extends \PHPUnit_Framework_TestCase
{
    /** @var Manager */
    private $manager;

    public function setUp()
    {
        $this->manager = new Manager();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThatRendererTriesAllOptions()
    {
        $provider1 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');
        $provider1
            ->expects($this->once())
            ->method('supports')
            ->will($this->returnValue(false));

        $provider2 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');
        $provider2
            ->expects($this->once())
            ->method('supports')
            ->will($this->returnValue(false));

        $twig = $this->getMock('Twig_Environment');

        $this->manager->addProvider($provider1, 'a');
        $this->manager->addProvider($provider2, 'b');

        $this->manager->initRuntime($twig);

        $this->manager->render('http://example.com');
    }

    public function testThatRendererTriesExactType()
    {
        $provider1 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');
        $provider1->expects($this->once())
            ->method('render')
            ->will($this->returnValue('html'));

        $provider2 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');

        $twig = $this->getMock('Twig_Environment');

        $this->manager->addProvider($provider1, 'a');
        $this->manager->addProvider($provider2, 'b');

        $this->manager->initRuntime($twig);

        $response = $this->manager->render('http://example.com', 'a');

        $this->assertEquals('html', $response);
    }

    public function testThatRendererTriesExactType2()
    {
        $provider1 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');

        $provider2 = $this->getMock('Protalk\MediaBundle\MediaType\ProviderInterface');
        $provider2->expects($this->once())
            ->method('render')
            ->will($this->returnValue('html'));

        $twig = $this->getMock('Twig_Environment');

        $this->manager->addProvider($provider1, 'a');
        $this->manager->addProvider($provider2, 'b');

        $this->manager->initRuntime($twig);

        $response = $this->manager->render('http://example.com', 'b');

        $this->assertEquals('html', $response);
    }
}
