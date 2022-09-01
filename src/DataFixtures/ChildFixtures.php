<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\Child;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ChildFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($usr = 1; $usr <= 5; $usr++){
            $child = new Child();
                $child->setEmail($faker->email);
               
                
            $child->setName($faker->lastName);
            $child->setFirstname($faker->firstName);
            $child->setAddress($faker->streetAddress);
            $child->setZipcode(str_replace(' ', '', $faker->postcode));
            $child->setCity($faker->city); 
           // $child->setPhone($faker->phoneNumber);
            $child->setIsMedical(true);
            $child->setCertificatyear('2020');
            $child->setBirthdate($faker->dateTime);
            $child->setIsValid(mt_rand(0,1) == 1 ? true :false);

        $manager->persist($child);  
    }

        $manager->flush();
    }
}