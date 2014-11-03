<?php

namespace Protalk\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    const DEFAULT_PLAIN_PASSWORD = 'password';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Sets the Container associated with this Controller.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $factory = $this->container->get('security.encoder_factory');

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@protalk.me');
        $user->setPlainPassword(self::DEFAULT_PLAIN_PASSWORD);
        $password = $factory->getEncoder($user)->encodePassword(self::DEFAULT_PLAIN_PASSWORD, $user->getSalt());
        $user->setPassword($password);
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
        $user->setSuperAdmin(true);
        $manager->persist($user);

        $this->addReference('user#admin', $user);

        $user = new User();
        $user->setUsername('john');
        $user->setEmail('john@protalk.me');
        $user->setPlainPassword(self::DEFAULT_PLAIN_PASSWORD);
        $password = $factory->getEncoder($user)->encodePassword(self::DEFAULT_PLAIN_PASSWORD, $user->getSalt());
        $user->setPassword($password);
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $this->addReference('user#regular', $user);

        $user = new User();
        $user->setUsername('jane');
        $user->setEmail('jane@protalk.me');
        $user->setPlainPassword(self::DEFAULT_PLAIN_PASSWORD);
        $password = $factory->getEncoder($user)->encodePassword(self::DEFAULT_PLAIN_PASSWORD, $user->getSalt());
        $user->setPassword($password);
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        $this->addReference('user#alternate', $user);

        $manager->flush();
    }
}
