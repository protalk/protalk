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
use Protalk\MediaBundle\Entity\Speaker;

class LoadSpeakerData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $joeBloggs = new Speaker();
        $joeBloggs->setName('Joe Bloggs');
        $joeBloggs->setBiography("This is Joe Bloggs' bio.");

        $janeBloggs = new Speaker();
        $janeBloggs->setName('Jane Bloggs');
        $janeBloggs->setBiography("This is Jane Bloggs' bio.");

        $nilsAdermann = new Speaker();
        $nilsAdermann->setName('Nils Adermann');
        $nilsAdermann->setPhoto(null);
        $nilsAdermann->setBiography('');

        $lornaMitchell = new Speaker();
        $lornaMitchell->setName('Lorna Mitchell');
        $lornaMitchell->setPhoto(null);
        $lornaMitchell->setBiography('');

        $calEvans = new Speaker();
        $calEvans->setName('Cal Evans');
        $calEvans->setPhoto(null);
        $calEvans->setBiography('');

        $derickRethans = new Speaker();
        $derickRethans->setName('Derick Rethans');
        $derickRethans->setPhoto(null);
        $derickRethans->setBiography('');

        $manager->persist($joeBloggs);
        $manager->persist($janeBloggs);
        $manager->persist($nilsAdermann);
        $manager->persist($lornaMitchell);
        $manager->persist($calEvans);
        $manager->persist($derickRethans);

        $manager->flush();

        $this->addReference('joe-bloggs', $joeBloggs);
        $this->addReference('jane-bloggs', $janeBloggs);
        $this->addReference('nils-adermann', $nilsAdermann);
        $this->addReference('lorna-mitchell', $lornaMitchell);
        $this->addReference('cal-evans', $calEvans);
        $this->addReference('derick-rethans', $derickRethans);
    }
}
