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
         $price->setAdult('60€');
         $price->setChild('40€');
         $price->setYear('2021-2022');
         $manager->persist($price);

        $manager->flush();
    }
}