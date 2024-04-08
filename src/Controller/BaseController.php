<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;


class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ProduitRepository $ProduitRepository): Response
    {
        $produits = $ProduitRepository -> findAll();
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
            'produits'=>$produits
        ]);
    }
}
