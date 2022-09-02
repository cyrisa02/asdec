<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
         $contact = new Contact();
         $contact->setFullname($faker->name());
         $contact->setEmail($faker->email);
         $contact->setContent($faker->sentence($nbWords = 10, $variableNbWords = true));
         $manager->persist($contact);

        }

        $manager->flush();
    }
}