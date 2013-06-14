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
use Protalk\MediaBundle\Entity\Language;

class LoadLanguageData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $php = new Language();
        $php->setName('PHP');
        $php->setSlug('php');

        $javascript = new Language();
        $javascript->setName('JavaScript');
        $javascript->setSlug('javascript');

        $manager->persist($php);
        $manager->persist($javascript);

        $manager->flush();

        $this->addReference('php', $php);
        $this->addReference('javascript', $javascript);
    }
}
