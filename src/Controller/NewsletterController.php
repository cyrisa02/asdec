<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewsletterUserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsletter')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'app_newsletter')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {       
        $user = new User();
        $form = $this->createForm(NewsletterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

             $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('newsletter/index.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
}}