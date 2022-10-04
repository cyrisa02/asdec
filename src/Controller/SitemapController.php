<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This Controller create the Sitemap for the SEO
 */

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults: ['_format'=>'xml'])]
    public function index(Request $request): Response
    {
        // On récuère le hostname grâce à la request et à getScheme
        $hostname = $request->getSchemeAndHttpHost();
        // dd($hostname);
        // Création d'un tableau pour stocker les URL du site
        $urls= [];
        // J'envoie les URL dans ce tableau, on va pousser les données
        // balise loc
        $urls[] = ['loc' => $this->generateUrl('home.index')];
        $urls[] = ['loc' => $this->generateUrl('cvg')];
        $urls[] = ['loc' => $this->generateUrl('rgpd')];
        $urls[] = ['loc' => $this->generateUrl('app_register_member')];
        $urls[] = ['loc' => $this->generateUrl('app_contact_new')];        
        $urls[] = ['loc' => $this->generateUrl('app_login')];
        // dd($urls);
        //Formatage de ces données en xml
        // Créer une réponse avec des paramètres : twig, url, hostname, statut code 200
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls'=>$urls,
                'hostname'=>$hostname,
            ]),
            200
        );
        //Modification de l'en-tête, le content type
        $response->headers->set('Content-type', 'text/xml' );
        return $response;
    }
}