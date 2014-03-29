<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Contribution;

class ContributionData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $contribution = new Contribution();
        $contribution->setName('Anthony Ferrara');
        $contribution->setEmail('bogus@email.com');
        $contribution->setHostUrl('https://www.youtube.com/watch?v=CV4vPsEizJM');
        $contribution->setTitle('Paradigm Soup');
        $contribution->setTags('PHP, Paradigms, Procedural, Functional, OOP');
        $manager->persist($contribution);
        $this->addReference('contribution#one', $contribution);

        $contribution = new Contribution();
        $contribution->setName('Thijs Feryn');
        $contribution->setEmail('bogus@email.com');
        $contribution->setHostUrl('http://blog.ibuildings.com/2013/01/14/dpcradioscalability-issues-cure-first-prevent-later/');
        $contribution->setTitle('Scalability Issues: Cure First, Prevent Later');
        $contribution->setTags('scalability, php');
        $manager->persist($contribution);
        $this->addReference('contribution#two', $contribution);

        $contribution = new Contribution();
        $contribution->setName('Igor Wiedler');
        $contribution->setEmail('bogus@email.com');
        $contribution->setHostUrl('https://vimeo.com/51201498');
        $contribution->setTitle('Silex Anatomy');
        $contribution->setTags('silex, php, symfony');
        $manager->persist($contribution);
        $this->addReference('contribution#three', $contribution);

        $contribution = new Contribution();
        $contribution->setName('Evan Coury');
        $contribution->setEmail('bogus@email.com');
        $contribution->setHostUrl('http://zendcon.com/');
        $contribution->setTitle('Introduction to Modules in Zend Framework 2');
        $contribution->setTags(null);
        $manager->persist($contribution);
        $this->addReference('contribution#four', $contribution);

        $manager->flush();
    }
}
