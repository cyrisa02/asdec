<?php

namespace App\Tests\Functional;

use App\Entity\Child;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChildTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        // Récupérer l'urlgenerator
        $urlGenerator = $client->getContainer()->get('router');

        // Récup entity manager, il faut être connecté , 58=child

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Child::class, 58);

        $client->loginUser($user);

        // Se rendre sur la page de création d'un enfant
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_child_new') );

        // Gérer le formulaire
        $form = $crawler->filter("form[name=registration_form_type_child]")->form([
            'registration_form_type_child[email]' => "johndoe@gmail.com",
            'registration_form_type_child[name]' => "Doe",
            'registration_form_type_child[firstname]' => "John ",            
            'registration_form_type_child[address]' => "27 rue des Lilas",
            'registration_form_type_child[zipcode]' => "02200",
            'registration_form_type_child[city]' => "Soissons",            
            'registration_form_type_child[phone]' => "067777",
            'registration_form_type_child[birthdate]' => "2012-03-10",
            'registration_form_type_child[is_valid]' => True,
            'registration_form_type_child[is_medical]' => True,
            'registration_form_type_child[certificatyear]' => "2012-03-10",
            'registration_form_type_child[parentname]' => "Doe",
            'registration_form_type_child[parentfirstname]' => "John",
            'registration_form_type_child[picture]' => "Doe",
            'registration_form_type_child[cardnr]' => "15",
        ]);
        $client->submit($form);

        //Gérer la redirection

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été enregistrée avec succès');

        $this->assertRouteSame('home_index');

        // Bien vérifier que le token du formulaire est bien dans les balises form grâce à l'insspecteur du navigateur        
    }

    public function testIfListChildIsSuccessfull(): void
    {
        $client = static::createClient();

        // Récupérer l'urlgenerator
        $urlGenerator = $client->getContainer()->get('router');

        // Récup entity manager, il faut être connecté , 58=child

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Child::class, 58);

        $client->loginUser($user);

        // Se rendre sur la page de création d'un franchisé
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_child_index') );

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('app_child_index');
    }

    public function testIfUpdateAChildIsSuccessfull(): void
    {
        $client = static::createClient();
        
        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Child::class, 58);
        
        $client->loginUser($user);
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('app_child_edit', [7])
        );

     
        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=child]')->form([
            
            'child[zipcode]'=>"02180",
            'child[is_valid]'=> false,
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été enregistrée avec succès');

        $this->assertRouteSame('app_child_index');
    }

    public function testIfDeleteAChildIsSuccessfull(): void

    {
        $client = static::createClient();
        
        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(Child::class, 58);
        

        $client->loginUser($user);
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('app_child_delete', [58])
        );     
       
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été supprimée avec succès');

        $this->assertRouteSame('app_child_index');

    }
}