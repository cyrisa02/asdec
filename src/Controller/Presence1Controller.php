<?php

namespace App\Controller;

use App\Entity\Presence1;
use App\Form\Presence1Type;
use App\Repository\Presence1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/presence1')]
class Presence1Controller extends AbstractController
{
    #[Route('/', name: 'app_presence1_index', methods: ['GET'])]
    public function index(Presence1Repository $presence1Repository): Response
    {
        return $this->render('presence1/index.html.twig', [
            'presence1s' => $presence1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_presence1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Presence1Repository $presence1Repository): Response
    {
        $presence1 = new Presence1();
        $form = $this->createForm(Presence1Type::class, $presence1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presence1Repository->add($presence1, true);

            return $this->redirectToRoute('app_presence1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presence1/new.html.twig', [
            'presence1' => $presence1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presence1_show', methods: ['GET'])]
    public function show(Presence1 $presence1): Response
    {
        return $this->render('presence1/show.html.twig', [
            'presence1' => $presence1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presence1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presence1 $presence1, Presence1Repository $presence1Repository): Response
    {
        $form = $this->createForm(Presence1Type::class, $presence1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presence1Repository->add($presence1, true);

            return $this->redirectToRoute('app_presence1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presence1/edit.html.twig', [
            'presence1' => $presence1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presence1_delete', methods: ['POST'])]
    public function delete(Request $request, Presence1 $presence1, Presence1Repository $presence1Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presence1->getId(), $request->request->get('_token'))) {
            $presence1Repository->remove($presence1, true);
        }

        return $this->redirectToRoute('app_presence1_index', [], Response::HTTP_SEE_OTHER);
    }


      #[Route('/makeItValide/{page}/{id}', name: 'app_salle_valide', methods: ['GET', 'POST'])]
    public function makeItValide($page, int $id, Presence1Repository $presence1Repository, Request $request): Response
    {


        $presence1 = $presence1Repository->find($id);
        if ($presence1->isIsPresent()) {
            $presence1->setIsPresent(false);
        } else {
            $presence1->setIsPresent(true);
        }

        $presence1Repository->add($presence1, true);

        $this->addFlash(
            'success',
            'Le statut de l\'utilisateur vient d\'être modifié'
        );


        //  return $this->redirectToRoute('app_timecard_showdo', [
        //      'page' => $page,           
        //   ], Response::HTTP_SEE_OTHER);


         // Vu qu'il y a un rechargement de la page j'ai besoin de revenir sur ma page qui
         //a un id différent, donc pbm Some mandatory parameters are missing ("id") to
         // generate a URL for route "app_timecard_showdo".         

        return $this->redirect($_SERVER['HTTP_REFERER']);

       // return $this->redirect($request->server['HTTP_REFERER']);

    }
}