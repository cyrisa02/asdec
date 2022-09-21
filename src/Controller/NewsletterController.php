<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsletter')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'app_newsletter_index', methods: ['GET'])]
    public function index(NewsletterRepository $newsletterRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $newsletter = $newsletterRepository->findAll();

        $newsletter =$paginator->paginate(
            $newsletter,
            
            $request->query->getInt('page', 1),
           1
        );
        return $this->render('pages/newsletter/index.html.twig', [
            'newsletters' => $newsletter,
        ]);
    }

    #[Route('/creation', name: 'app_newsletter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsletterRepository $newsletterRepository): Response
    {
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $newsletterRepository->add($newsletter, true);

            return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/newsletter/new.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
        ]);
    }

     #[Route('/send/{id}', name: 'send', methods: ['GET'])]
    public function send(Newsletter $newsletter, MailerInterface $mailer): Response
    {
        $users = $newsletter->getCategories()->getUsers();
        

        foreach ($users as $user){
            if($user->isIsValid()){
                $email = (new TemplatedEmail())
                ->from('asdecsoissons@gmail.com')
                ->to ($user->getEmail())                
                ->subject($newsletter->getName())
                ->htmlTemplate('emails/newsletter.html.twig')
                ->context(compact('newsletter','user'));
                $mailer->send($email);
            }
        }

        return $this->render('pages/newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }
    #[Route('/sendall/{id}', name: 'sendall', methods: ['GET'])]
    public function sendall(Newsletter $newsletter, MailerInterface $mailer): Response
    {
        $users = $newsletter->getCategories()->getUsers();
        

        foreach ($users as $user){
            
                $email = (new TemplatedEmail())
                ->from('asdecsoissons@gmail.com')
                ->to ($user->getEmail())                
                ->subject($newsletter->getName())
                ->htmlTemplate('emails/newsletter.html.twig')
                ->context(compact('newsletter','user'));
                $mailer->send($email);
            }
        

        return $this->render('pages/newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    #[Route('/{id}', name: 'app_newsletter_show', methods: ['GET'])]
    public function show(Newsletter $newsletter): Response
    {
        return $this->render('pages/newsletter/show.html.twig', [
            'newsletter' => $newsletter,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_newsletter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Newsletter $newsletter, NewsletterRepository $newsletterRepository): Response
    {
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsletterRepository->add($newsletter, true);

            return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/newsletter/edit.html.twig', [
            'newsletter' => $newsletter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_newsletter_delete', methods: ['POST'])]
    public function delete(Request $request, Newsletter $newsletter, NewsletterRepository $newsletterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsletter->getId(), $request->request->get('_token'))) {
            $newsletterRepository->remove($newsletter, true);
        }

        return $this->redirectToRoute('app_newsletter_index', [], Response::HTTP_SEE_OTHER);
    }
}