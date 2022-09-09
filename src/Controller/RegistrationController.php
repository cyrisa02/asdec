<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\MailService;
use App\Security\UserAuthenticator;
use App\Form\RegistrationBoardFormType;
use App\Form\RegistrationMemberFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

/**
 * The first method displays the registration for the member, the second method displays
 * for the board
 */

class RegistrationController extends AbstractController
{
    #[Route('/inscription_adherent', name: 'app_register_member')]
    public function registermember(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager,MailService $mailService): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationMemberFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            

            $user->setRoles(["ROLE_MEMBER"])
            // encode the plain password
                  ->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
            
            // Email J'ai injecté le MailService $mailService
            $mailService->sendEmail(
                $user->getEmail(),                
                'emails/memberregistration.html.twig',
                ['user'=>$user]
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/registermember.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/inscription_representant', name: 'app_register_board')]
    public function registerboard(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationBoardFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_BOARD"])
            // encode the plain password
                  ->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/registerboard.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}