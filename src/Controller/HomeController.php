<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller displays the HomepPage 
 */
class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}