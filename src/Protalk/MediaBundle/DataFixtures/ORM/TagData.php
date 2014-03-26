<?php

namespace Protalk\MediaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\MediaBundle\Entity\Tag;

class TagData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 10;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {

        $tags = array(
            'PHP', 'Quality Assurance', 'MySQL', 'php|tek', 'Arrays', 'PHPUnit', 'Refactoring', 'Tools',
            'Build Process', 'Deployment', 'Integration', 'dpc12', 'PHPDocumentor', 'Security', 'Design Patterns',
            'phpnw11', 'dpc11', 'Webservices', 'Optimisation', 'CouchDB', 'Scalability', 'Zend Framework',
            'Zend Framework 2', 'Symfony2', 'Interview', 'symfony_live11', 'Dependency Injection', 'AOP', 'Apostrophe',
            'CMS', 'Git', 'phpday2011', 'Varnish', 'Caching', 'WordPress', 'SEO', 'Codeception', 'Selenium',
            'Acceptance Testing', 'afup2012', 'Continuous Integration', 'Paradigms', 'Procedural', 'Functional',
            'OOP', 'tutorial', 'screencast', 'zendcon2012', 'Encryption', 'Cryptography', 'References', 'PHP Internals',
            'Kings of Code', 'phpnw12', 'Sencha Touch 2', 'Mobile', 'HTML5', 'business', 'API', 'HTML5 Canvas',
            'Travis CI', 'SPL', 'Parser', 'Profiling', 'Performance', 'AWS', 'Debugging', 'Logging', 'Twig',
            'Mentoring', 'ccxx12', 'MicroPHP', 'devhell', 'tek12', 'tnphp', 'SASS', 'ElasticSearch', 'Vagrant',
            'phpbn13'
        );

        foreach ($tags as $tag) {
            $this->createTag($manager, $tag);
        }

        $manager->flush();
    }

    public function createTag(ObjectManager $manager, $name)
    {
        $tag = new Tag();
        $tag->setName($name);

        $manager->persist($tag);
        $this->addReference('tag#'.strtolower($name), $tag);
    }
}
