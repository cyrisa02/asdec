<?php

namespace App\Controller;

use App\Entity\Goodies;
use App\Form\GoodiesType;
use App\Repository\GoodiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/objet_publicitaire')]
class GoodiesController extends AbstractController
{
    #[Route('/', name: 'app_goodies_index', methods: ['GET'])]
    public function index(GoodiesRepository $goodiesRepository): Response
    {
        return $this->render('pages/goodies/index.html.twig', [
            'goodies' => $goodiesRepository->findAll(),
        ]);
    }

    #[Route('/création', name: 'app_goodies_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GoodiesRepository $goodiesRepository): Response
    {
        $goody = new Goodies();
        $form = $this->createForm(GoodiesType::class, $goody);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Ajout de la photo
            $file = $request->files->get('goodies')['my_file'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();  
            $file->move(
                $uploads_directory,
                $filename);
                // Comment sauveagrder en BD, champ picture
            $goody->setPicture($filename);
            //$goodiesRepository->add($goody, true);

            $goodiesRepository->add($goody, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_goodies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/goodies/new.html.twig', [
            'goody' => $goody,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goodies_show', methods: ['GET'])]
    public function show(Goodies $goody): Response
    {
        return $this->render('pages/goodies/show.html.twig', [
            'goody' => $goody,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_goodies_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goodies $goody, GoodiesRepository $goodiesRepository): Response
    {
        $form = $this->createForm(GoodiesType::class, $goody);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $goodiesRepository->add($goody, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_goodies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/goodies/edit.html.twig', [
            'goody' => $goody,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goodies_delete', methods: ['POST'])]
    public function delete(Request $request, Goodies $goody, GoodiesRepository $goodiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goody->getId(), $request->request->get('_token'))) {
            $goodiesRepository->remove($goody, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_goodies_index', [], Response::HTTP_SEE_OTHER);
    }
}