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

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Protalk\MediaBundle\Entity\Media;
use Protalk\MediaBundle\Entity\Mediatype;

class LoadMediaData extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $phpbb4 = new Media();
        $phpbb4->setMediatype($this->getReference('video'));
        $phpbb4->setSpeakers(
            new ArrayCollection(
                array(
                    $this->getReference('nils-adermann')
                )
            )
        );

        $phpbb4->setDate(new \Datetime());
        $phpbb4->setCreationDate(new \DateTime());
        $phpbb4->setTitle('phpBB4: Building end-user applications with Symfony2');
        $phpbb4->setContent('<iframe class="player" frameborder="0" scrolling="no" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/web//player-html5-568.html" width="400" height="300"><noframes><img alt="&lt;h2&gt;3 Mars Session 05 Symfony&lt;/h2&gt;" src="http://playertv-bscdn-admin.pad-playertv.brainsonic.com/uploads/32/20110309-193143/photo_1.jpg" /><h2>3 Mars Session 05 Symfony</h2></noframes></iframe>');
        $phpbb4->setLength('04:00');
        $phpbb4->setRating(2.5);
        $phpbb4->setVisits(100);
        $phpbb4->setLanguage('EN');
        $phpbb4->setHostName('Symfony');
        $phpbb4->setHostUrl('http://symfony.com/video/Paris2011/568');
        $phpbb4->setStatus('pub');

        $toolUpYourLampStack = new Media();
        $toolUpYourLampStack->setMediatype($this->getReference('video'));
        $toolUpYourLampStack->setDate(new \DateTime());
        $toolUpYourLampStack->setCreationDate(new \DateTime());
        $toolUpYourLampStack->setTitle('Tool Up Your Lamp Stack');
        $toolUpYourLampStack->setDescription('A talk about peripheral tools that aid web development');
        $toolUpYourLampStack->setContent("<iframe src=\"http://player.vimeo.com/video/30012690\" width=\"500\" height=\"409\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
        $toolUpYourLampStack->setLength('1hr 20mins');
        $toolUpYourLampStack->setRating(0);
        $toolUpYourLampStack->setVisits(100);
        $toolUpYourLampStack->setLanguage('en');
        $toolUpYourLampStack->setHostName('Vimeo');
        $toolUpYourLampStack->setHostUrl('http://vimeo.com/30012690/');
        $toolUpYourLampStack->setStatus('pub');

        $manager->persist($phpbb4);
        $manager->persist($toolUpYourLampStack);
        $manager->flush();

        $this->addReference('phpbb4', $phpbb4);
        $this->addReference('toolUpYourLampStack', $toolUpYourLampStack);
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
            'Protalk\MediaBundle\Tests\Fixtures\LoadMediatypeData',
        );
    }
}
