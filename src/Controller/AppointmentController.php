<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Repository\MedecinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RendezVous;
use App\Form\RendezVousType;
use Doctrine\ORM\EntityManagerInterface;

class AppointmentController extends AbstractController
{
    #[Route('/appointment', name: 'app_appointment')]
    public function index(): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('appointment/index.html.twig', [
            'controller_name' => 'AppointmentController',
        ]);
    }

    #[Route('/prendre/rendez-vous', name: 'app_prendre_rdv', methods: ['GET', 'POST'])]
    public function rendezVous(MedecinRepository $medecinRepository, PaginatorInterface $paginator, Request $request): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        $domaine = $request->query->get('domaine');
        $ville = $request->query->get('ville');

        $query = $medecinRepository->findMedecinByCriteria($domaine, $ville);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('appointment/prendreRdv.html.twig', [
            'controller_name' => 'AppointmentController',
            'pagination' => $pagination,
        ]);
    }

    #[Route('/rendez-vous/{id}', name: 'app_rdv_medecin', methods: ['GET', 'POST'])]
    public function rendezVousMedecin(Medecin $medecin, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        $rendezVous = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVous);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rendezVous->setMedecin($medecin);
            $entityManager->persist($rendezVous);
            $entityManager->flush();
            return $this->redirectToRoute('app_appointment', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appointment/ficheMedecin.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }
}

