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
use Doctrine\Common\Collections\ArrayCollection;
use Protalk\MediaBundle\Entity\Media;
use Protalk\MediaBundle\Entity\Mediatype;
use Protalk\MediaBundle\Entity\Speaker;
use Protalk\MediaBundle\Entity\Category;
use Protalk\MediaBundle\Entity\Tag;

class LoadMediaData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $videoType = new Mediatype();
        $videoType->setName('video');
        $videoType->setType('video');

        $manager->persist($videoType);

        $speaker1 = new Speaker();
        $speaker1->setName('Joe Bloggs');

        $speaker1->setBiography('Joe Bloggs bio.');

        $manager->persist($speaker1);

        $category1 = new Category();
        $category1->setName('PHP');
        $category1->setSlug('php');

        $manager->persist($category1);

        $tag1 = new Tag();
        $tag1->setName('PHPNW');
        $tag1->setSlug('phpnw');

        $manager->persist($tag1);

        $video1 = new Media();
        $video1->setMediatype($videoType);
        $video1->setSpeakers(
            new ArrayCollection(
                array(
                    $speaker1
                )
            )
        );

        $video1->setCategories(
            new ArrayCollection(
                array(
                    $category1
                )
            )
        );

        $video1->setTags(
            new ArrayCollection(
                array(
                    $tag1
                )
            )
        );

        $video1->setDate(new \Datetime());
        $video1->setCreationDate(new \DateTime());
        $video1->setTitle('My video about PHP');
        $video1->setDescription('A video about PHP!');
        $video1->setContent('http://some.video-url.com');
        $video1->setLength('20:00:00');
        $video1->setRating(2.5);
        $video1->setVisits(100);
        $video1->setLanguage('EN');
        $video1->setHostName('PHP');
        $video1->setHostUrl('php');
        $video1->setStatus('pub');
        $manager->persist($video1);
        $manager->flush();
    }
}