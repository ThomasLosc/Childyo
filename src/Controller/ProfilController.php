<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Repository\EnfantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;


class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(EnfantRepository $enfant): Response
    {
        $enfants = $enfant->findBy(['user' => $this->getUser()]);

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'enfants' => $enfants
        ]);
    }

    #[Route('/{id}/profil', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/edit_user.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
