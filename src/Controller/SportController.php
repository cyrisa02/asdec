<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportType;
use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sport')]
class SportController extends AbstractController
{
    #[Route('/', name: 'app_sport_index', methods: ['GET'])]
    public function index(SportRepository $sportRepository): Response
    {
        return $this->render('pages/sport/index.html.twig', [
            'sports' => $sportRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_sport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SportRepository $sportRepository): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sportRepository->add($sport, true);

             $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sport_show', methods: ['GET'])]
    public function show(Sport $sport): Response
    {
        return $this->render('pages/sport/show.html.twig', [
            'sport' => $sport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sport $sport, SportRepository $sportRepository): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sportRepository->add($sport, true);

            $this->addFlash('success', 'Votre modification a été enregistrée avec succès');

            return $this->redirectToRoute('app_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sport_delete', methods: ['POST'])]
    public function delete(Request $request, Sport $sport, SportRepository $sportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $sportRepository->remove($sport, true);
            $this->addFlash('success', 'Votre activité a été supprimée avec succès');
        }

        return $this->redirectToRoute('app_sport_index', [], Response::HTTP_SEE_OTHER);
    }
}