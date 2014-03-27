<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Category;

class CategoryData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
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

        $php = new Category();
        $php->setName('PHP');
        $php->setSlug('php');
        $manager->persist($php);
        $this->addReference('category#php', $php);

        $oop = new Category();
        $oop->setName('OOP');
        $oop->setSlug('oop');
        $oop->setParentId($php);
        $manager->persist($oop);
        $this->addReference('category#oop', $oop);

        $api = new Category();
        $api->setName('API');
        $api->setSlug('api');
        $api->setParentId($php);
        $manager->persist($api);
        $this->addReference('category#api', $api);

        $conferences = new Category();
        $conferences->setName('Conferences');
        $conferences->setSlug('conferences');
        $manager->persist($conferences);
        $this->addReference('category#conferences', $conferences);

        $phpnw = new Category();
        $phpnw->setName('PHPNW');
        $phpnw->setSlug('phpnw');
        $phpnw->setParentId($conferences);
        $manager->persist($phpnw);
        $this->addReference('category#phpnw', $phpnw);

        $dpc = new Category();
        $dpc->setName('DPC');
        $dpc->setSlug('dpc');
        $dpc->setParentId($conferences);
        $manager->persist($dpc);
        $this->addReference('category#dpc', $dpc);

        $dp = new Category();
        $dp->setName('DP');
        $dp->setSlug('dp');
        $dp->setParentId($oop);
        $manager->persist($dp);
        $this->addReference('category#dp', $dp);

        $manager->flush();

    }
}
