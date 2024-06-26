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

        $prixProduits = [];
        foreach ($produits as $produit) {
        $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 8); 
        if (!$associer) {
            $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 15);
        }
        $prixProduits[$produit->getId()] = $associer ? $associer->getPrix() : 'Prix non disponible';
        }
        
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
            'produits'=>$produits,
            'prixProduits' => $prixProduits,
            
        ]);
    }
}
