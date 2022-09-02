<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ReregistrationType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * This Controller allows to register for the second time
 */
#[Route('/reinscription')]
class ReregistrationController extends AbstractController
{
    #[Route('/', name: 'app_reregistration_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('pages/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_reregistration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reregistration_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('pages/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_reregistration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(ReregistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/reregistration/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    
}