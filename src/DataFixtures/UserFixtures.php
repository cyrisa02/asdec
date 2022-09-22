<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('cyrisa02.test@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);        
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setName('Gourdon');
         $admin->setFirstname('Cyril');
        $admin->setAddress('2, allée des Anges');
        $admin->setZipcode('02200');
        $admin->setCity('Soissons');
        // $admin->setPhone('0606060606');
        $admin->setBirthdate(\DateTime::createFromFormat('d-m-Y','05-02-1973')); 
        $admin->setJob('Développeur'); 
        $admin->setIsMedical(true);
        $admin->setCertificatyear('2020');
        $admin->setIsValid(true); 

        $manager->persist($admin);  

        $faker = Faker\Factory::create('fr_FR');
        for($usr = 1; $usr <= 5; $usr++){
            $user = new User();
                $user->setEmail($faker->email);
                $user->setRoles(['ROLE_MEMBER']);
                $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'azerty')
        );
            $user->setName($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipcode(str_replace(' ', '', $faker->postcode));
            $user->setCity($faker->city); 
           // $user->setPhone($faker->phoneNumber);
            $user->setJob('Profession');  
            $user->setBirthdate($faker->dateTime);
            $user->setIsMedical(true);
            $user->setCertificatyear('2020');
            $user->setIsValid(mt_rand(0,1) == 1 ? true :false);

        $manager->persist($user);  
    }

        $manager->flush();
    }
}