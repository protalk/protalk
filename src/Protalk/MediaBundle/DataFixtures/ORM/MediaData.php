<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Media;
use Protalk\MediaBundle\Entity\MediaLanguageCategory;
use Protalk\MediaBundle\Entity\MediaSpeaker;
use Protalk\MediaBundle\Entity\MediaTag;

class MediaData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setMediatype($this->getReference('mediatype#video'));
        $media->setDate(new \DateTime('2012/12/03'));
        $media->setDescription('Identify trouble areas in your code, learn how to refactor them and train you to write better code in future projects avoiding common pitfalls.');
        $media->setLength('47:25');
        $media->setRating(5);
        $media->setVisits(8894);
        $media->setContent('<iframe width="500" height="315" src="http://www.youtube.com/embed/H2AvoAzbGOE" frameborder="0" allowfullscreen></iframe>');
        $media->setSlides('<iframe src="http://www.slideshare.net/slideshow/embed_code/15471808" width="427" height="356" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" allowfullscreen webkitallowfullscreen mozallowfullscreen> </iframe>');
        $media->setJoindin('');
        $media->setLanguage('en');
        $media->setTitle('Your code sucks, let\'s fix it');
        $media->setSlug('your-code-sucks-lets-fix-it');
        $media->setIsImported(0);
        $media->setHostName('Kings of Code Developers Festival');
        $media->setHostUrl('http://www.youtube.com/watch?v=H2AvoAzbGOE');
        $media->setThumbnail('http://img.youtube.com/vi/H2AvoAzbGOE/default.jpg');
        $media->setCreationDate(new \DateTime());
        $media->setStatus('pub');
        $manager->persist($media);
        $this->addReference('media#your-code-sucks', $media);
        $this->assignLanguageCategory($manager, $media, 'cat_lang#design-patterns#php');
        $this->assignSpeaker($manager, $media, 'speaker#rdohms');
        $this->assignTags($manager, $media, array('tag#php', 'tag#refactoring', 'tag#kings-of-code', 'tag#design-patterns'));


        $media = new Media();
        $media->setMediatype($this->getReference('mediatype#podcast'));
        $media->setDate(new \DateTime('2012/08/14'));
        $media->setDescription('A Voices of the Elephpant Interview with Lineke Kerckhoffs-Willems by Cal Evans');
        $media->setLength('14:21');
        $media->setRating(2.5);
        $media->setVisits(450);
        $media->setContent('http://voices.of.the.elephpant.s3.amazonaws.com/vote_061.mp3');
        $media->setSlides(null);
        $media->setJoindin(null);
        $media->setLanguage('en');
        $media->setTitle('Interview with Lineke Kerckhoffs-Willems');
        $media->setSlug('interview-with-lineke-kerckhoffs-willems');
        $media->setIsImported(0);
        $media->setHostName('Voices of the Elephpant');
        $media->setHostUrl('http://voicesoftheelephpant.com/');
        $media->setThumbnail(null);
        $media->setCreationDate(new \DateTime());
        $media->setStatus('pub');
        $manager->persist($media);
        $this->addReference('media#voe', $media);
        $this->assignLanguageCategory($manager, $media, 'cat_lang#dpc#php');
        $this->assignSpeaker($manager, $media, 'speaker#cal');
        $this->assignTags($manager, $media, array('tag#php', 'tag#interview', 'tag#dpc12', 'tag#api'));

        $media = new Media();
        $media->setMediatype($this->getReference('mediatype#video'));
        $media->setDate(new \DateTime('2012-10-11'));
        $media->setDescription('');
        $media->setLength('00:47:04');
        $media->setRating(0);
        $media->setVisits(0);
        $media->setContent('<iframe width="500" height="315" src="http://www.youtube.com/embed/BdO4xz64VjQ" frameborder="0" allowfullscreen></iframe>');
        $media->setSlides(null);
        $media->setJoindin(null);
        $media->setLanguage('en');
        $media->setTitle('SymfonyLive Paris 2012 - Guilherme Blanco - ORMs don\'t kill your database, developers do!');
        $media->setSlug('symfonylive-paris-2012-guilherme-blanco-orms-don-t-kill-your-database-developers-do');
        $media->setIsImported(1);
        $media->setHostName('SensioLabs');
        $media->setHostUrl('http://www.youtube.com/watch?v=BdO4xz64VjQ&amp;feature=youtube_gdata');
        $media->setThumbnail('http://i.ytimg.com/vi/BdO4xz64VjQ/default.jpg');
        $media->setCreationDate(new \DateTime());
        $media->setStatus('pend');
        $manager->persist($media);
        $this->addReference('media#orm', $media);
        $this->assignLanguageCategory($manager, $media, 'cat_lang#oop#php');
        $this->assignSpeaker($manager, $media, 'speaker#blanco');
        $this->assignTags($manager, $media, array('tag#php', 'tag#performance', 'tag#symfony_live11', 'tag#oop', 'tag#tools', 'tag#optimisation'));

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param Media $media
     * @param string $catLangReference
     */
    public function assignLanguageCategory($manager, $media, $catLangReference)
    {
        $mlc = new MediaLanguageCategory();
        $mlc->setMedia($media);
        $mlc->setLanguageCategory($this->getReference($catLangReference));

        $manager->persist($mlc);
    }

    /**
     * @param ObjectManager $manager
     * @param Media $media
     * @param string $speakerReference
     */
    public function assignSpeaker($manager, $media, $speakerReference)
    {
        $speakerMedia = new MediaSpeaker();
        $speakerMedia->setMedia($media);
        $speakerMedia->setSpeaker($this->getReference($speakerReference));

        $manager->persist($speakerMedia);
    }

    /**
     * @param ObjectManager $manager
     * @param Media $media
     * @param array $tagReferences
     */
    public function assignTags($manager, $media, $tagReferences)
    {
        foreach ($tagReferences as $tagReferences) {
            $mediaTag = new MediaTag();
            $mediaTag->setMedia($media);
            $mediaTag->setTag($this->getReference($tagReferences));

            $manager->persist($mediaTag);
        }
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return array(
            'Protalk\MediaBundle\DataFixtures\ORM\TagData',
            'Protalk\MediaBundle\DataFixtures\ORM\SpeakerData',
            'Protalk\MediaBundle\DataFixtures\ORM\CategoryData',
            'Protalk\MediaBundle\DataFixtures\ORM\MediatypeData',
        );
    }
}
