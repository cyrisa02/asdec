<?php

namespace App\Controller;

use App\Entity\Timecard1;
use App\Form\Timecard1Type;
use App\Repository\Timecard1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/timecard1')]
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
    public function new(Request $request, Timecard1Repository $timecard1Repository): Response
    {
        $timecard1 = new Timecard1();
        $form = $this->createForm(Timecard1Type::class, $timecard1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timecard1Repository->add($timecard1, true);

            return $this->redirectToRoute('app_timecard1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard1/new.html.twig', [
            'timecard1' => $timecard1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard1_show', methods: ['GET'])]
    public function show(Timecard1 $timecard1): Response
    {
        return $this->render('timecard1/show.html.twig', [
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
}