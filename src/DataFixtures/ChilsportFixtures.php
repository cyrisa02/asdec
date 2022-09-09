<?php

namespace App\DataFixtures;

use App\Entity\Childsport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChilsportFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $sport = new Childsport();
        $sport->setTitle('Badminton -de 16 ans')
            ->setPlace('Gymnase Gérard Philipe')            
            ->setDay('Mardi')
            ->setStart('18h15')
            ->setEnd('19h45')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Childsport();
        $sport->setTitle('Natation -de 16 ans')
            ->setPlace('Piscine "Les bains du Lac" ')            
            ->setDay('Vendredi')
            ->setStart('19h45')
            ->setEnd('21h')
            ->setPeopleNbr('Doit être accompagné(e) d\'un adhérent adulte (pas forcément un parent)');
        $manager->persist($sport);

        $sport = new Childsport();
        $sport->setTitle('Gym -de 9 ans')
            ->setPlace('Salle des sport de Crouy Rue Pierre Ledoux (derrière l\'église')            
            ->setDay('Samedi')
            ->setStart('10h')
            ->setEnd('11h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        $sport = new Childsport();
        $sport->setTitle('Gym de 10 ans à 15 ans')
            ->setPlace('Salle des sport de Crouy Rue Pierre Ledoux (derrière l\'église')            
            ->setDay('Samedi')
            ->setStart('11h')
            ->setEnd('12h')
            ->setPeopleNbr('non renseigné');
        $manager->persist($sport);

        

        $manager->flush();
    }
}