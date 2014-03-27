<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Mediatype;

class MediatypeData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 10;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $type = new Mediatype();
        $type->setName('video');
        $type->setType('video');
        $manager->persist($type);
        $this->addReference('mediatype#video', $type);

        $type = new Mediatype();
        $type->setName('podcast');
        $type->setType('podcast');
        $manager->persist($type);
        $this->addReference('mediatype#podcast', $type);

        $manager->flush();
    }
}
