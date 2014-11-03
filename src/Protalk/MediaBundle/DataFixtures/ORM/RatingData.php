<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Rating;

class RatingData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $rating = new Rating();
        $rating->setIpaddress('33.33.10.10');
        $rating->setMedia($this->getReference('media#your-code-sucks'));
        $rating->setRating(5);
        $manager->persist($rating);

        $rating = new Rating();
        $rating->setIpaddress('33.33.10.10');
        $rating->setMedia($this->getReference('media#your-code-sucks'));
        $rating->setRating(5);
        $manager->persist($rating);

        $rating = new Rating();
        $rating->setIpaddress('33.33.10.10');
        $rating->setMedia($this->getReference('media#voe'));
        $rating->setRating(5);
        $manager->persist($rating);

        $rating = new Rating();
        $rating->setIpaddress('33.33.10.10');
        $rating->setMedia($this->getReference('media#voe'));
        $rating->setRating(2);
        $manager->persist($rating);

        $rating = new Rating();
        $rating->setIpaddress('33.33.10.10');
        $rating->setMedia($this->getReference('media#voe'));
        $rating->setRating(3);
        $manager->persist($rating);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return array(
            'Protalk\MediaBundle\DataFixtures\ORM\MediaData'
        );
    }
}
