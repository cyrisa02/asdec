<?php

namespace App\Controller;

use App\Entity\Child;
use App\Form\ChildType;
use App\Repository\ChildRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/enfant')]
class ChildController extends AbstractController
{
    #[Route('/', name: 'app_child_index', methods: ['GET'])]
    public function index(ChildRepository $childRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $childs = $childRepository->findAll();

        $childs =$paginator->paginate(
            $childs,
            
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('pages/child/index.html.twig', [
            'children' => $childs,
        ]);
    }

    #[Route('/creation', name: 'app_child_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChildRepository $childRepository): Response
    {
        $child = new Child();
        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $childRepository->add($child, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/child/new.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_child_show', methods: ['GET'])]
    public function show(Child $child): Response
    {
        return $this->render('pages/child/show.html.twig', [
            'child' => $child,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_child_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Child $child, ChildRepository $childRepository): Response
    {
        $form = $this->createForm(ChildType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $childRepository->add($child, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/child/edit.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_child_delete', methods: ['POST'])]
    public function delete(Request $request, Child $child, ChildRepository $childRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$child->getId(), $request->request->get('_token'))) {
            $childRepository->remove($child, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_child_index', [], Response::HTTP_SEE_OTHER);
    }
}