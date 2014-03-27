<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Feed;

class FeedData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 20;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $feed = new Feed();
        $feed->setFeedtype($this->getReference('feedtype#feedburner'));
        $feed->setName('DPC and DMC 2012');
        $feed->setUrl('http://feeds.feedburner.com/Ibuildingsblog?format=xml');
        $feed->setAutomaticImport(true);
        $feed->setContact('Joni Overbosch, Ibuildings');
        $feed->setConfirmation('person');
        $feed->setMediatype($this->getReference('mediatype#video'));
        $manager->persist($feed);
        $this->addReference('feed#dpc', $feed);

        $feed = new Feed();
        $feed->setFeedtype($this->getReference('feedtype#feedburner'));
        $feed->setName('Devhell Podcast');
        $feed->setUrl('http://feeds.feedburner.com/devhell-podcast');
        $feed->setAutomaticImport(false);
        $feed->setContact('Funkatron');
        $feed->setConfirmation('twitter');
        $feed->setMediatype($this->getReference('mediatype#podcast'));
        $manager->persist($feed);
        $this->addReference('feed#devhell', $feed);

        $feed = new Feed();
        $feed->setFeedtype($this->getReference('feedtype#vimeo'));
        $feed->setName('Atlanta PHP User Group');
        $feed->setUrl('http://vimeo.com/atlantaphp/videos/rss');
        $feed->setAutomaticImport(true);
        $feed->setContact('Kevin Roberts');
        $feed->setConfirmation('email');
        $feed->setMediatype($this->getReference('mediatype#video'));
        $manager->persist($feed);
        $this->addReference('feed#atlanta', $feed);

        $manager->flush();
    }
}
