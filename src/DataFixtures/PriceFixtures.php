<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PriceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $price = new Price();
         $price->setAdult('Adhésion 60€');
         $price->setChild('Adhésion 40€');
         $price->setYear('2022-2023');
         $price->setisTicket(0);
         $manager->persist($price);


         $price = new Price();
         $price->setAdult('Yoga 70€ annuel');
         $price->setChild('Pas de Yoga');
         $price->setYear('2022-2023');
         $price->setisTicket(1);
         $manager->persist($price);

         $price = new Price();
         $price->setAdult('Pilates 100€ annuel');
         $price->setChild('Pas de Pilates');
         $price->setYear('2022-2023');
         $price->setisTicket(1);
         $manager->persist($price);

        $manager->flush();
    }
}