<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Category;
use Protalk\MediaBundle\Entity\Language;
use Protalk\MediaBundle\Entity\LanguageCategory;

class CategoryData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $php = new Category();
        $php->setName('PHP');
        $manager->persist($php);
        $this->addReference('category#php', $php);
        $this->assignLanguage($manager, $php, 'language#php');

        $oop = new Category();
        $oop->setName('OOP');
        $oop->setParentId($php);
        $manager->persist($oop);
        $this->addReference('category#oop', $oop);
        $this->assignLanguage($manager, $oop, 'language#php');

        $api = new Category();
        $api->setName('API');
        $api->setParentId($php);
        $manager->persist($api);
        $this->addReference('category#api', $api);
        $this->assignLanguage($manager, $api, 'language#php');

        $conferences = new Category();
        $conferences->setName('Conferences');
        $manager->persist($conferences);
        $this->addReference('category#conferences', $conferences);
        $this->assignLanguage($manager, $conferences, 'language#php');

        $phpnw = new Category();
        $phpnw->setName('PHPNW');
        $phpnw->setParentId($conferences);
        $manager->persist($phpnw);
        $this->addReference('category#phpnw', $phpnw);
        $this->assignLanguage($manager, $phpnw, 'language#php');

        $dpc = new Category();
        $dpc->setName('DPC');
        $dpc->setParentId($conferences);
        $manager->persist($dpc);
        $this->addReference('category#dpc', $dpc);
        $this->assignLanguage($manager, $dpc, 'language#php');

        $dp = new Category();
        $dp->setName('Design Patterns');
        $dp->setParentId($oop);
        $manager->persist($dp);
        $this->addReference('category#design-patterns', $dp);
        $this->assignLanguage($manager, $dp, 'language#php');

        $manager->flush();

    }

    /**
     * @param ObjectManager $manager
     * @param Category $category
     * @param string $languageReference
     */
    public function assignLanguage($manager, $category, $languageReference)
    {
        /** @var Language $language */
        $language = $this->getReference($languageReference);

        $categoryLanguage = new LanguageCategory();
        $categoryLanguage->setCategory($category);
        $categoryLanguage->setLanguage($language);

        $this->addReference("cat_lang#{$category->getSlug()}#{$language->getSlug()}", $categoryLanguage);

        $manager->persist($categoryLanguage);
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
            'Protalk\MediaBundle\DataFixtures\ORM\LanguageData'
        );
    }

}
