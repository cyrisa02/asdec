<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $order = new Order();
         $order->setArticleNr('2') 
         ->setCustomer('John Doe')  
         ->setTitle('T-shirt Homme')
          ->setIsSended(false)
         ->setComment('Pas de commentaire');
         $manager->persist($order);

         $order = new Order();
         $order->setArticleNr('3')  
          ->setCustomer('Jimy Hendrix')  
         ->setTitle('T-shirt Femme')
          ->setIsSended(false)
         ->setComment('Pas de commentaire');
         $manager->persist($order);

         $order = new Order();
         $order->setArticleNr('1')  
          ->setCustomer('Robert Johnson')   
         ->setTitle('T-shirt Enfant')
         ->setIsSended(false)
         ->setComment('Pas de commentaire');
         
         $manager->persist($order);

        $manager->flush();
    }
}