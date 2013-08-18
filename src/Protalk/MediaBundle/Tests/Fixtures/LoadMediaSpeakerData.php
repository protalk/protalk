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
use Protalk\MediaBundle\Entity\MediaSpeaker;
use Protalk\MediaBundle\Entity\Speaker;
use Protalk\MediaBundle\Entity\Media;

class LoadMediaSpeakerData extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $nils = new MediaSpeaker();
        $nils->setSpeaker($this->getReference('nils-adermann'));
        $nils->setMedia($this->getReference('phpbb4'));

        $lorna = new MediaSpeaker();
        $lorna->setSpeaker($this->getReference('lorna-mitchell'));
        $lorna->setMedia($this->getReference('toolUpYourLampStack'));


        $manager->persist($nils);
        $manager->persist($lorna);

        $manager->flush();

        $this->addReference('nils', $nils);
        $this->addReference('lorna', $lorna);
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
            'Protalk\MediaBundle\Tests\Fixtures\LoadSpeakerData',
            'Protalk\MediaBundle\Tests\Fixtures\LoadMediaData',
        );
    }
}
