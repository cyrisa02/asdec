<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $sport = new Sport();

         $sport->setTitle('Gymnastique - Lundi')
            ->setPlace('Gymnase Lamartine')
            ->setDay('Lundi')
            ->setStart('19h')
            ->setEnd('20h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Badminton - Lundi')
            ->setPlace('Gymnase Gérard Philipe')
            ->setDay('Lundi')
            ->setStart('20h30')
            ->setEnd('23h30')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Pilates - Lundi')
            ->setPlace('Gymnase Jean Davesne salle à l\'étage')
            ->setDay('Lundi')
            ->setStart('20h30')
            ->setEnd('21h15')
            ->setPeopleNbr('20 à 24 personnes par séance');
        $manager->persist($sport);


        


        $sport = new Sport();
        $sport->setTitle('Yoga - Mardi')
            ->setPlace('Gymnase Jean Davesne Salle à l\'étage')            
            ->setDay('Mardi')
            ->setStart('18h15')
            ->setEnd('19h15')
            ->setPeopleNbr('20 à 24 personnes par séance');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Gymnastique - Mardi')
            ->setPlace('Gymnase Gérard Philipe')            
            ->setDay('Mardi')
            ->setStart('20h')
            ->setEnd('21h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Badminton - Mardi')
            ->setPlace('Gymnase Gérard Philipe')            
            ->setDay('Mardi')
            ->setStart('21h')
            ->setEnd('23h30')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Gymnastique - Mercredi')
            ->setPlace('Gymnase Gérard Philipe')            
            ->setDay('Mercredi')
            ->setStart('20h')
            ->setEnd('21h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Sport de raquettes - Mercredi')
            ->setPlace('Gymnase Jean Davesne Salle à l\'étage')            
            ->setDay('Mercredi')
            ->setStart('20h')
            ->setEnd('22h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Badminton - Jeudi')
            ->setPlace('Gymnase Gérard Philipe')            
            ->setDay('Jeudi')
            ->setStart('20h30')
            ->setEnd('23h30')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Yoga - Jeudi')
            ->setPlace('Salle polyvalente de Crouy derrière la Mairie')            
            ->setDay('Jeudi')
            ->setStart('17h00')
            ->setEnd('18h00')
            ->setPeopleNbr('15personnes par séance /  séance 1');
        $manager->persist($sport);

        $sport = new Sport();
        $sport->setTitle('Yoga - Jeudi')
            ->setPlace('Salle polyvalente de Crouy derrière la Mairie')            
            ->setDay('Jeudi')
            ->setStart('18h15')
            ->setEnd('19h15')
            ->setPeopleNbr('15personnes par séance /  séance 2');
        $manager->persist($sport);

        $manager->flush();
    }
}