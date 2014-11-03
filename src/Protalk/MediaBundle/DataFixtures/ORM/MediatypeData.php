<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Mediatype;

class MediatypeData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
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
