<?php

namespace App\DataFixtures;

use App\Entity\Goodies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GoodiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $goodie = new Goodies();
         $goodie->setTitle('T-shirt Homme')
         ->setPrice('Aucune idée')
         ->setColor('Aucune idée')
         ->setSize('M');         
         $manager->persist($goodie);

         $goodie = new Goodies();
         $goodie->setTitle('T-shirt Femme')
         ->setPrice('Aucune idée')
         ->setColor('Aucune idée')
         ->setSize('M');         
         $manager->persist($goodie);


         $goodie = new Goodies();
         $goodie->setTitle('T-shirt Enfant')
         ->setPrice('Aucune idée')
         ->setColor('Aucune idée')
         ->setSize('M');         
         $manager->persist($goodie);

        $manager->flush();
    }
}