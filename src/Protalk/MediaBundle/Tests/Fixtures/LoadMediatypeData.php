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
use Protalk\MediaBundle\Entity\Mediatype;

class LoadMediatypeData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $videoType = new Mediatype();
        $videoType->setName('video');
        $videoType->setType('video');

        $conferenceVideo = new Mediatype();
        $conferenceVideo->setName('conference video');
        $conferenceVideo->setType('video');

        $podcast = new Mediatype();
        $podcast->setName('podcast');
        $podcast->setType('podcast');

        $conferencePodcast = new Mediatype();
        $conferencePodcast->setName('conference podcast');
        $conferencePodcast->setType('podcast');

        $manager->persist($videoType);
        $manager->persist($conferenceVideo);
        $manager->persist($podcast);
        $manager->persist($conferencePodcast);

        $manager->flush();

        $this->addReference('video', $videoType);
        $this->addReference('conference-video', $conferenceVideo);
        $this->addReference('podcast', $podcast);
        $this->addReference('conference-podcast', $conferencePodcast);
    }
}
