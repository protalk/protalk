<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Language;

class LanguageData extends AbstractFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $lang = new Language();
        $lang->setName('PHP');
        $lang->setSlug('php');
        $manager->persist($lang);
        $this->addReference('language#php', $lang);

        $lang = new Language();
        $lang->setName('JS');
        $lang->setSlug('js');
        $manager->persist($lang);
        $this->addReference('language#js', $lang);

        $manager->flush();
    }
}
