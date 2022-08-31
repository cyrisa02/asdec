<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * This controller displays the HomePage and the posts
 */
class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
      

        return $this->render('pages/home.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/posts/{id}', name: 'show_post')]
    public function show(Post $post){

        return $this->render('pages/post/post.html.twig', [
            'post' => $post,
        ]);

    }
}