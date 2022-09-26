<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Entity\Timecard;
use App\Form\PresenceType;
use App\Repository\PresenceRepository;
use App\Repository\TimecardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * It doesn't work, please see Presence1
 */
#[Route('/presence')]
class PresenceController extends AbstractController
{
    #[Route('/', name: 'app_presence_index', methods: ['GET'])]
    public function index(PresenceRepository $presenceRepository): Response
    {
        return $this->render('presence/index.html.twig', [
            'presences' => $presenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_presence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PresenceRepository $presenceRepository): Response
    {
        $presence = new Presence();
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presenceRepository->add($presence, true);

            return $this->redirectToRoute('app_presence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presence/new.html.twig', [
            'presence' => $presence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presence_show', methods: ['GET'])]
    public function show(Presence $presence): Response
    {
        return $this->render('presence/show.html.twig', [
            'presence' => $presence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Presence $presence, PresenceRepository $presenceRepository): Response
    {
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presenceRepository->add($presence, true);

            return $this->redirectToRoute('app_presence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presence/edit.html.twig', [
            'presence' => $presence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presence_delete', methods: ['POST'])]
    public function delete(Request $request, Presence $presence, PresenceRepository $presenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presence->getId(), $request->request->get('_token'))) {
            $presenceRepository->remove($presence, true);
        }

        return $this->redirectToRoute('app_presence_index', [], Response::HTTP_SEE_OTHER);
    }


    // #[Route('/makeItValide/{page}/{id}', name: 'app_salle_valide', methods: ['GET', 'POST'])]
    // public function makeItValide($page, int $id, PresenceRepository $presenceRepository, Request $request): Response
    // {


    //     $presence = $presenceRepository->find($id);
    //     if ($presence->isIsPresent()) {
    //         $presence->setIsPresent(false);
    //     } else {
    //         $presence->setIsPresent(true);
    //     }

    //     $presenceRepository->add($presence, true);

    //     $this->addFlash(
    //         'success',
    //         'Le statut de l\'utilisateur vient d\'être modifié'
    //     );


        //  return $this->redirectToRoute('app_timecard_showdo', [
        //      'page' => $page,           
        //   ], Response::HTTP_SEE_OTHER);


         // Vu qu'il y a un rechargement de la page j'ai besoin de revenir sur ma page qui
         //a un id différent, donc pbm Some mandatory parameters are missing ("id") to
         // generate a URL for route "app_timecard_showdo".         

    //     return $this->redirect($_SERVER['HTTP_REFERER']);

    //    // return $this->redirect($request->server['HTTP_REFERER']);

    // }


}