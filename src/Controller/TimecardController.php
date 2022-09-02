<?php

namespace App\Controller;

use App\Entity\Timecard;
use App\Form\TimecardType;
use App\Repository\TimecardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche_d_appel')]
class TimecardController extends AbstractController
{
    #[Route('/', name: 'app_timecard_index', methods: ['GET'])]
    public function index(TimecardRepository $timecardRepository): Response
    {
        return $this->render('pages/timecard/index.html.twig', [
            'timecards' => $timecardRepository->findAll(),
        ]);
    }

    #[Route('/création', name: 'app_timecard_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TimecardRepository $timecardRepository): Response
    {
        $timecard = new Timecard();
        $form = $this->createForm(TimecardType::class, $timecard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timecardRepository->add($timecard, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard/new.html.twig', [
            'timecard' => $timecard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard_show', methods: ['GET'])]
    public function show(Timecard $timecard): Response
    {
        return $this->render('pages/timecard/show.html.twig', [
            'timecard' => $timecard,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_timecard_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Timecard $timecard, TimecardRepository $timecardRepository): Response
    {
        $form = $this->createForm(TimecardType::class, $timecard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timecardRepository->add($timecard, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_timecard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard/edit.html.twig', [
            'timecard' => $timecard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard_delete', methods: ['POST'])]
    public function delete(Request $request, Timecard $timecard, TimecardRepository $timecardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timecard->getId(), $request->request->get('_token'))) {
            $timecardRepository->remove($timecard, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_timecard_index', [], Response::HTTP_SEE_OTHER);
    }
}