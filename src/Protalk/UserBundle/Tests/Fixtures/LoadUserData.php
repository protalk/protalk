<?php

namespace CrickLog\CoreBundle\Tests\Fixtures;

use Protalk\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $userOne = new User();
        $userOne->setFirstname('Joe');
        $userOne->setLastname('Blogs');
        $userOne->setUsername('Joe Bloggs');
        $userOne->setEmail('jb@example.com');
        $userOne->setPlainPassword('123');
        $userOne->setEnabled(true);
        $userOne->setRoles(array('ROLE_USER'));

        $userTwo = new User();
        $userTwo->setFirstname('Ann');
        $userTwo->setLastname('Other');
        $userTwo->setUsername('Ann Other');
        $userTwo->setEmail('ao@example.com');
        $userTwo->setPlainPassword('123');
        $userTwo->setEnabled(true);
        $userTwo->setRoles(array('ROLE_USER'));

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@example.com');
        $admin->setPlainPassword('master');
        $admin->setEnabled(true);
        $admin->setRoles(array('ROLE_SUPER_ADMIN'));

        $manager->persist($userOne);
        $manager->persist($userTwo);
        $manager->persist($admin);

        $manager->flush();

        $this->addReference('userOne', $userOne);
        $this->addReference('userTwo', $userTwo);
    }
}