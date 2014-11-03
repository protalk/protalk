<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Comment;

class CommentData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setMedia($this->getReference('media#your-code-sucks'));
        $comment->setAuthor('Kim Rowan');
        $comment->setEmail('bogus@email.com');
        $comment->setWebsite('http://protalk.me');
        $comment->setDatetime(new \DateTime());
        $comment->setContent('Awesome site! Great talk too');
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setMedia($this->getReference('media#your-code-sucks'));
        $comment->setAuthor('Michelle Sanver');
        $comment->setEmail('bogus@email.com');
        $comment->setWebsite('http://www.jippey.com');
        $comment->setDatetime(new \DateTime());
        $comment->setContent('I learned a lot from this amazing talk.  Great topic.');
        $manager->persist($comment);

        $comment = new Comment();
        $comment->setMedia($this->getReference('media#voe'));
        $comment->setAuthor('Skoop');
        $comment->setEmail('bogus@email.com');
        $comment->setWebsite(null);
        $comment->setDatetime(new \DateTime());
        $comment->setContent('Great Interview!');
        $manager->persist($comment);

        $manager->flush();
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
            'Protalk\MediaBundle\DataFixtures\ORM\MediaData'
        );
    }

}
