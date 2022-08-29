<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller displays the CVG, the RGPD and the Readme
 */
class PagesController extends AbstractController
{
    #[Route('/cvg', name: 'cvg')]
    public function indexcvg(): Response
    {
        return $this->render('pages/cvg.html.twig');
    }

    #[Route('/rgpd', name: 'rgpd', methods: ['GET'])]
    public function indexrgpd(): Response
    {
        return $this->render('pages/rgpd.html.twig');
    }

    #[Route('/readme', name: 'readme', methods: ['GET'])]
    public function readme(): Response
    {
        return $this->render('pages/readme.html.twig');
    }

}