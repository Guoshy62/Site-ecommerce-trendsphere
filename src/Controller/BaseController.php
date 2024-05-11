<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Entity\Associer;
use App\Repository\ProduitRepository;
use App\Repository\AssocierRepository;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(ProduitRepository $ProduitRepository,AssocierRepository $associerRepository): Response
    {
        $produits = $ProduitRepository->findAll();
        shuffle($produits);

        /*
        $associer = $associerRepository->findBy(['taille' => 8]);
     if (empty($associer)) {
         $associer = $associerRepository->findBy(['taille' => 14]);
     }*/

        
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
            'produits'=>$produits,
            /*'associer'=>$associer,*/
        ]);
    }
}
