<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Speaker;

class SpeakerData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $speaker = new Speaker();
        $speaker->setName('Cal Evans');
        $speaker->setBiography("Many moons ago, at the tender age of 14, Cal touched his first computer. (Weâ€™re using the term â€œcomputerâ€ loosely here, it was a TRS-80 Model 1) Since then his life has never been the same. He graduated from TRS-80s to Commodores and eventually to IBM PCâ€™s.\r\nFor the past 13 years Cal has worked with PHP and MySQL on Linux, OSX, and Windows. He has built a variety of projects ranging in size from simple web pages to multi-million dollar web applications. When not banging his head on his monitor, attempting a blood sacrifice to get a particular piece of code working, he enjoys building and managing development teams using his widely imitated but never patented management style of â€œmanagement by wandering aroundâ€.\r\n\r\nThese days, when not working with PHP, Cal can be found working on a variety of projects, most of which require a higher security clearance than you have so they canâ€™t be listed here.\r\n\r\nCal is based in Nashville TN where he is gainfully unemployed as the Chief Marketing Officer of Blue Parabola, LLC.\r\n\r\nCal is happily married to wife 1.28, the lovely and talented Kathy. Together they have 2 wonderful kids who were both smart enough not to pursue a job in IT.");
        $manager->persist($speaker);
        $this->addReference('speaker#cal', $speaker);

        $speaker = new Speaker();
        $speaker->setName('Rafael Dohms');
        $speaker->setBiography("Computer Engineer, PHP Evangelist and Gamer. Enabler of the AmsterdamPHP Community. Loves code and growing communities.");
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
