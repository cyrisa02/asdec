<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Entity\Sport;
use App\Entity\Timecard;
use App\Form\TimecardType;
use App\Repository\PresenceRepository;
use App\Repository\SportRepository;
use App\Repository\TimecardRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche_d_appel')]
class TimecardController extends AbstractController
{
    #[Route('/', name: 'app_timecard_index', methods: ['GET'])]
    public function index(TimecardRepository $timecardRepository, SportRepository $sportRepository): Response
    {
        return $this->render('pages/timecard/index.html.twig', [
            'timecards' => $timecardRepository->findAll(),
            'sports' => $sportRepository->findAll(),
        ]);
    }

    #[Route('/création', name: 'app_timecard_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TimecardRepository $timecardRepository, EntityManagerInterface $entityManager ): Response
    {
        $timecard = new Timecard();
        $form = $this->createForm(TimecardType::class, $timecard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presence = new Presence();

            /**
             * @var User $user
             */
            $user=$this->getUser();
            $sport = $user->getSports();
            
            $presence->setIsPresent(0);
            $presence->setUsers($this->getUser())
           
            ->setTimecards($timecard);
           
            $entityManager->persist($presence);
            $entityManager->persist($user);
            $entityManager->flush();
            $timecardRepository->add($timecard, true);
            
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard/new.html.twig', [
            'timecard' => $timecard,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_timecard_show', methods: ['GET'])]
    // public function show(Timecard $timecard): Response
    // {
    //     return $this->render('pages/timecard/show.html.twig', [
    //         'timecard' => $timecard,
    //     ]);
    // }

    #[Route('/{id}/edition', name: 'app_timecard_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Timecard $timecard, TimecardRepository $timecardRepository): Response
    {
        $form = $this->createForm(TimecardType::class, $timecard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timecardRepository->add($timecard, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');

            return $this->redirectToRoute('app_timecard_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/timecard/edit.html.twig', [
            'timecard' => $timecard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timecard_delete', methods: ['POST'])]
    public function delete(Request $request, Timecard $timecard, TimecardRepository $timecardRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timecard->getId(), $request->request->get('_token'))) {
            $timecardRepository->remove($timecard, true);
            $this->addFlash('success', 'Votre demande a été enregistrée avec succès');
        }

        return $this->redirectToRoute('app_timecard_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/fiche/{id}', name: 'app_timecarddo_index', methods: ['GET'])]
    public function indexdo(TimecardRepository $timecardRepository, SportRepository $sportRepository, UserRepository $userRepository,Timecard $timecard, Sport $sport): Response
    {
        return $this->render('pages/timecard/indexdo.html.twig', [
            'timecards' => $timecardRepository->findAll(),
            'sports' => $sportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'timecard' => $timecard,
            'sport' => $sport,
        ]);
    }


    #[Route('/{id}', name: 'app_timecard_showdo', methods: ['GET'])]
    public function showdo(Timecard $timecard, SportRepository $sportRepository, UserRepository $userRepository, PresenceRepository $presenceRepository): Response
    {
        return $this->render('pages/timecard/showdo.html.twig', [
            'timecard' => $timecard,
            'sports' => $sportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'presences' => $presenceRepository->findAll(),
            
        ]);
    }

    #[Route('/impression/{id}', name: 'app_timecard_printdo', methods: ['GET'])]
    public function printdo(Timecard $timecard, SportRepository $sportRepository, UserRepository $userRepository, PresenceRepository $presenceRepository): Response
    {
        return $this->render('pages/timecard/printdo.html.twig', [
            'timecard' => $timecard,
            'sports' => $sportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'presences' => $presenceRepository->findAll(),
            
        ]);
    }

   
}