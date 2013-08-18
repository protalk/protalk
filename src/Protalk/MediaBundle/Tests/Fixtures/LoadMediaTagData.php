<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Tests\Fixtures;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\MediaTag;
use Protalk\MediaBundle\Entity\Tag;
use Protalk\MediaBundle\Entity\Media;

class LoadMediaTagData extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $phpbb4Symfony = new MediaTag();
        $phpbb4Symfony->setTag($this->getReference('symfony'));
        $phpbb4Symfony->setMedia($this->getReference('phpbb4'));

        $toolUpYourLampStackQualityAssurance = new MediaTag();
        $toolUpYourLampStackQualityAssurance->setTag($this->getReference('quality-assurance'));
        $toolUpYourLampStackQualityAssurance->setMedia($this->getReference('toolUpYourLampStack'));


        $manager->persist($phpbb4Symfony);
        $manager->persist($toolUpYourLampStackQualityAssurance);

        $manager->flush();
    }

    /**
     * Load this fixtures dependencies
     * @see https://github.com/doctrine/data-fixtures
     *
     * @return array
     */
    public function getDependencies()
    {
        return array(
            'Protalk\MediaBundle\Tests\Fixtures\LoadTagData',
            'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData',
        );
    }
}
