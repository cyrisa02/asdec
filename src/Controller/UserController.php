<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\MailService;
use App\Form\UserEditSportType;
use App\Repository\SportRepository;
use App\Repository\SportUserRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/utilisateur')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request, SportUserRepository $sportUserRepository): Response
    {

        $users = $userRepository->findAll();

        $users =$paginator->paginate(
            $users,
            
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('pages/user/index.html.twig', [
            'users' => $users,
            'sport_users' => $sportUserRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
            // Ajout de la photo
            $file = $request->files->get('user')['my_file'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();  
            $file->move(
                $uploads_directory,
                $filename);
                // Comment sauveagrder en BD, champ picture
            $user->setPicture($filename);
            $userRepository->add($user, true);



            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('pages/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, MailService $mailService): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            // Email J'ai injecté le MailService $mailService
            $mailService->sendEmail(
                $user->getEmail(),                
                'emails/userafterpayment.html.twig',
                ['user'=>$user]
            );

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }



    #[Route('/{id}/edition_sport', name: 'app_user_editsport', methods: ['GET', 'POST'])]
    public function editsport(Request $request, User $user, UserRepository $userRepository, MailService $mailService): Response
    {
        $form = $this->createForm(UserEditSportType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            // Email J'ai injecté le MailService $mailService
            $mailService->sendEmail(
                $user->getEmail(),                
                'emails/userchangesport.html.twig',
                ['user'=>$user]
            );

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/user/editsport.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/carte/{id}', name: 'app_user_show_card', methods: ['GET'])]
    public function showcard(User $user): Response
    {
        return $this->render('pages/user/showcard.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/makeItValide1/{page}/{id}', name: 'app_salle_valide1', methods: ['GET', 'POST'])]
    public function makeItValide($page, int $id, UserRepository $userRepository, Request $request): Response
    {


        $user = $userRepository->find($id);
        if ($user->isIsValid()) {
            $user->setIsValid(false);
        } else {
            $user->setIsValid(true);
        }

        $userRepository->add($user, true);

        $this->addFlash(
            'success',
            'Le statut de l\'utilisateur vient d\'être modifié'
        );


        //  return $this->redirectToRoute('app_timecard_showdo', [
        //      'page' => $page,           
        //   ], Response::HTTP_SEE_OTHER);


         // Vu qu'il y a un rechargement de la page j'ai besoin de revenir sur ma page qui
         //a un id différent, donc pbm Some mandatory parameters are missing ("id") to
         // generate a URL for route "app_timecard_showdo".         

        return $this->redirect($_SERVER['HTTP_REFERER']);

       // return $this->redirect($request->server['HTTP_REFERER']);

    }

    
}