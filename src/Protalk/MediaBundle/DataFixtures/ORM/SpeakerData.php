<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Speaker;

class SpeakerData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $speaker = new Speaker();
        $speaker->setName('Cal Evans');
        $speaker->setBiography("Bio of Mr. Cal Evans");
        $manager->persist($speaker);
        $this->addReference('speaker#cal', $speaker);

        $speaker = new Speaker();
        $speaker->setName('Rafael Dohms');
        $speaker->setBiography(
            "Computer Engineer, PHP Evangelist and Gamer. Enabler of the AmsterdamPHP Community. Loves code and growing communities."
        );
        $manager->persist($speaker);
        $this->addReference('speaker#rdohms', $speaker);

        $speaker = new Speaker();
        $speaker->setName('Chris Hartjes');
        $manager->persist($speaker);
        $this->addReference('speaker#grumpy', $speaker);

        $speaker = new Speaker();
        $speaker->setName('Guilherme Blanco');
        $manager->persist($speaker);
        $this->addReference('speaker#blanco', $speaker);

        $manager->flush();
    }
}
