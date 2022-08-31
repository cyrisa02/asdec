<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\PriceType;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tarif')]
class PriceController extends AbstractController
{
    #[Route('/', name: 'app_price_index', methods: ['GET'])]
    public function index(PriceRepository $priceRepository): Response
    {
        return $this->render('pages/price/index.html.twig', [
            'prices' => $priceRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_price_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PriceRepository $priceRepository): Response
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $priceRepository->add($price, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_price_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/price/new.html.twig', [
            'price' => $price,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_price_show', methods: ['GET'])]
    public function show(Price $price): Response
    {
        return $this->render('pages/price/show.html.twig', [
            'price' => $price,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_price_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Price $price, PriceRepository $priceRepository): Response
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $priceRepository->add($price, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_price_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/price/edit.html.twig', [
            'price' => $price,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_price_delete', methods: ['POST'])]
    public function delete(Request $request, Price $price, PriceRepository $priceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            $priceRepository->remove($price, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_price_index', [], Response::HTTP_SEE_OTHER);
    }
}