<?php

namespace App\Controller;

use App\Entity\SportUser;
use App\Form\SportUserType;
use App\Repository\SportUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sport/user')]
class SportUserController extends AbstractController
{
    #[Route('/', name: 'app_sport_user_index', methods: ['GET'])]
    public function index(SportUserRepository $sportUserRepository): Response
    {
        return $this->render('sport_user/index.html.twig', [
            'sport_users' => $sportUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sport_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SportUserRepository $sportUserRepository): Response
    {
        $sportUser = new SportUser();
        $form = $this->createForm(SportUserType::class, $sportUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sportUserRepository->add($sportUser, true);

            return $this->redirectToRoute('app_sport_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport_user/new.html.twig', [
            'sport_user' => $sportUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sport_user_show', methods: ['GET'])]
    public function show(SportUser $sportUser): Response
    {
        return $this->render('sport_user/show.html.twig', [
            'sport_user' => $sportUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sport_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SportUser $sportUser, SportUserRepository $sportUserRepository): Response
    {
        $form = $this->createForm(SportUserType::class, $sportUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sportUserRepository->add($sportUser, true);

            return $this->redirectToRoute('app_sport_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport_user/edit.html.twig', [
            'sport_user' => $sportUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sport_user_delete', methods: ['POST'])]
    public function delete(Request $request, SportUser $sportUser, SportUserRepository $sportUserRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sportUser->getId(), $request->request->get('_token'))) {
            $sportUserRepository->remove($sportUser, true);
        }

        return $this->redirectToRoute('app_sport_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
