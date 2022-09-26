<?php

namespace App\Controller;

use App\Entity\Presence1;
use App\Entity\Timecard1;
use App\Form\Timecard1Type;
use App\Repository\UserRepository;
use App\Repository\SportRepository;
use App\Repository\Presence1Repository;
use App\Repository\Timecard1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fichedappel')]
class Timecard1Controller extends AbstractController
{
    #[Route('/', name: 'app_timecard1_index', methods: ['GET'])]
    public function index(Timecard1Repository $timecard1Repository): Response
    {
        return $this->render('pages/timecard1/index.html.twig', [
            'timecard1s' => $timecard1Repository->findAll(),
            
        ]);
    }

    #[Route('/creation', name: 'app_timecard1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Timecard1Repository $timecard1Repository, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {

        // Je crée une nouvelle entité fiche d'appel
        $timecard1 = new Timecard1();
        // Je crée le formulaire grâce au modèle Timecard1Type
        $form = $this->createForm(Timecard1Type::class, $timecard1);
        $form->handleRequest($request);
        //Si le formulaire est soumis et valide, je continue
        if ($form->isSubmitted() && $form->isValid()) {


        // Je flush-crée l'objet TimeCard1
        $timecard1Repository->add($timecard1, true);
            
            // J'ai besoin de la liste des users Faut il créer une fonction dans le repository de user findSport Voir Repository de User
            $users= $userRepository->findBySport($timecard1->getSports());
            //dd($users);
            // Je parcours un par un mes users dans une boucle
            foreach ($users as $user) {
                // Je crée l'entité Presence1 avec les champs users, timecards1 et IsPresent
            $presence1 = new Presence1();
                $presence1->setIsPresent(0)
                      ->setUsers($user) //il faudrait boucler sur tous les users
                      ->setTimecards1($timecard1);
                      $entityManager->persist($presence1);// Je prépare pour la BD
            }
            // Je flush quand tous les presence1 ont été persistés
            $entityManager->flush();

            
                      $this->addFlash('success', 'Votre fiche a été créée avec succès');
                    

            return $this->redirectToRoute('app_timecard1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard1/new.html.twig', [
            'timecard1' => $timecard1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard_showdo', methods: ['GET'])]
    public function showdo(Timecard1 $timecard1, SportRepository $sportRepository, UserRepository $userRepository, Presence1Repository $presence1Repository, Presence1 $presence1): Response
    {
        return $this->render('pages/timecard1/showdo.html.twig', [
            'timecard1' => $timecard1,
            'sports' => $sportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'presence1s' => $presence1Repository->findAll(),
            
        ]);
    }

    #[Route('/voir/{id}', name: 'app_timecard1_show', methods: ['GET'])]
    public function show(Timecard1 $timecard1): Response
    {
        return $this->render('pages/timecard1/show.html.twig', [
            'timecard1' => $timecard1,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_timecard1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Timecard1 $timecard1, Timecard1Repository $timecard1Repository): Response
    {
        $form = $this->createForm(Timecard1Type::class, $timecard1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timecard1Repository->add($timecard1, true);

            return $this->redirectToRoute('app_timecard1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard1/edit.html.twig', [
            'timecard1' => $timecard1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard1_delete', methods: ['POST'])]
    public function delete(Request $request, Timecard1 $timecard1, Timecard1Repository $timecard1Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timecard1->getId(), $request->request->get('_token'))) {
            $timecard1Repository->remove($timecard1, true);
        }

        return $this->redirectToRoute('app_timecard1_index', [], Response::HTTP_SEE_OTHER);
    }

     

    #[Route('/impression/{id}', name: 'app_timecard_printdo', methods: ['GET'])]
    public function printdo(Timecard1 $timecard1, SportRepository $sportRepository, UserRepository $userRepository, Presence1Repository $presence1Repository): Response
    {
        return $this->render('pages/timecard1/printdo.html.twig', [
            'timecard1' => $timecard1,
            'sports' => $sportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'presence1s' => $presence1Repository->findAll(),
            
        ]);
    }
}