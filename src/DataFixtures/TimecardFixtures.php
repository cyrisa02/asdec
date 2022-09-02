<?php

namespace App\DataFixtures;

use App\Entity\Timecard;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TimecardFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $timecard = new Timecard();
         $timecard->setResponsable('John Doe');
         $manager->persist($timecard);

         $timecard = new Timecard();
         $timecard->setResponsable('Jimy Hendrix');
         $manager->persist($timecard);

         $timecard = new Timecard();
         $timecard->setResponsable('Jim Morrison');
         $manager->persist($timecard);


        $manager->flush();
    }
}