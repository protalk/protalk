<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Feedtype;

class FeedtypeData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $type = new Feedtype();
        $type->setName('Bliptv');
        $type->setClassName('bliptv');
        $manager->persist($type);
        $this->addReference('feedtype#bliptv', $type);

        $type = new Feedtype();
        $type->setName('Youtube');
        $type->setClassName('youtube');
        $manager->persist($type);
        $this->addReference('feedtype#youtube', $type);

        $type = new Feedtype();
        $type->setName('Feedburner');
        $type->setClassName('feedburner');
        $manager->persist($type);
        $this->addReference('feedtype#feedburner', $type);

        $type = new Feedtype();
        $type->setName('Vimeo');
        $type->setClassName('vimeo');
        $manager->persist($type);
        $this->addReference('feedtype#vimeo', $type);

        $manager->flush();
    }
}
