<?php

namespace App\Controller;

use App\Entity\Childsport;
use App\Form\ChildsportType;
use App\Repository\ChildsportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/activites_enfant')]
class ChildsportController extends AbstractController
{
    #[Route('/', name: 'app_childsport_index', methods: ['GET'])]
    public function index(ChildsportRepository $childsportRepository): Response
    {
        return $this->render('pages/childsport/index.html.twig', [
            'childsports' => $childsportRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_childsport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChildsportRepository $childsportRepository): Response
    {
        $childsport = new Childsport();
        $form = $this->createForm(ChildsportType::class, $childsport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $childsportRepository->add($childsport, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_childsport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/childsport/new.html.twig', [
            'childsport' => $childsport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_childsport_show', methods: ['GET'])]
    public function show(Childsport $childsport): Response
    {
        return $this->render('pages/childsport/show.html.twig', [
            'childsport' => $childsport,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_childsport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Childsport $childsport, ChildsportRepository $childsportRepository): Response
    {
        $form = $this->createForm(ChildsportType::class, $childsport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $childsportRepository->add($childsport, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_childsport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/childsport/edit.html.twig', [
            'childsport' => $childsport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_childsport_delete', methods: ['POST'])]
    public function delete(Request $request, Childsport $childsport, ChildsportRepository $childsportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$childsport->getId(), $request->request->get('_token'))) {
            $childsportRepository->remove($childsport, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_childsport_index', [], Response::HTTP_SEE_OTHER);
    }
}