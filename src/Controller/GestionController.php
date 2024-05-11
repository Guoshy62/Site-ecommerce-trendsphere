<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\UserRepository;

class GestionController extends AbstractController
{
    #[Route('/mod-ajout-fichier', name: 'app_ajout')]
    public function ajout(): Response
    {
        return $this->render('gestion/ajout.html.twig', [
            'controller_name' => 'GestionController',
        ]);
    }

    #[Route('/mod-liste-users', name: 'app_liste_users')]
    public function listeUtilisateurs(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('gestion/liste-users.html.twig', [
            'users' => $users,
        ]);
    }
}
