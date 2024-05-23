<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwoFactorController extends AbstractController
{
    #[Route('/2fa', name: 'app_two_factor')]
    public function index(): Response
    {
        return $this->render('security/2fa.html.twig', [
            'controller_name' => 'TwoFactorController',
        ]);
    }
}
