<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\MailService;
use App\Form\ReregistrationType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * This Controller allows to register for the second time
 */
#[Route('/reinscription')]
class ReregistrationController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'app_reregistration_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $userRepository->findAll();

        $users =$paginator->paginate(
            $users,
            
            $request->query->getInt('page', 1),
            1005
            
        );
        return $this->render('pages/reregistration/index.html.twig', [
            'users' => $users,
        ]);
    }

     #[Route('/makeItDelete2/{id}', name: 'app_registration_delete', methods: ['GET', 'POST'])]
    public function makeItDelete( User $user, UserRepository $userRepository, Request $request): Response
    {

        $users= $userRepository->findAll();
        
        foreach ($users as $user) {
       
        if ($user->isIsRegistered()) {
            $user->setIsRegistered(false);
        }      
    }
    $userRepository->add($user, true);
        $this->addFlash(
            'success',
            'La Base de Données a été mise à jour avec succès'
        );             

        return $this->redirect($_SERVER['HTTP_REFERER']);       

    }

    #[Route('/creation', name: 'app_reregistration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(ReregistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/reregistration/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reregistration_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('pages/reregistration/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edition', name: 'app_reregistration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, MailService $mailService): Response
    {
        $form = $this->createForm(ReregistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            // Email J'ai injecté le MailService $mailService
            $mailService->sendEmail(
                $user->getEmail(),                
                'emails/reregistration.html.twig',
                ['user'=>$user]
            );

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/reregistration/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    
}