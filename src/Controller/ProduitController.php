<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/sneakers', name: 'app_sneakers')]
    public function index(): Response
    {
        return $this->render('produit/sneakers.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
