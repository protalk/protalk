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
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Speaker;

class LoadSpeakersData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $speaker1 = new Speaker();
        $speaker1->setName('Joe Bloggs');
        $speaker1->setBiography("This is Joe Bloggs' bio.");

        $speaker2 = new Speaker();
        $speaker2->setName('Jane Bloggs');
        $speaker2->setBiography("This is Jane Bloggs' bio.");

        $manager->persist($speaker1);
        $manager->persist($speaker2);
        $manager->flush();
    }
}