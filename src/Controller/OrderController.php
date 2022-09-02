<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Form\OrdernewType;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commande')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'app_order_index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('pages/order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrderRepository $orderRepository): Response
    {
        $order = new Order();
        $form = $this->createForm(OrdernewType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->add($order, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/order/new.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Order $order): Response
    {
        return $this->render('pages/order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Order $order, OrderRepository $orderRepository): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->add($order, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/order/edit.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, OrderRepository $orderRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $orderRepository->remove($order, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}