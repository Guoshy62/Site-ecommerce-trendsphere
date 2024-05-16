<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AssocierRepository;

class RechercheController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, ProduitRepository $produitRepository,AssocierRepository $associerRepository): Response
    {
        $query = $request->query->get('q');
        $produits = $produitRepository->findBySearchQuery($query);

        $prixProduits = [];
        foreach ($produits as $produit) {
        $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 8); 
        if (!$associer) {
            $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 15);
        }
        $prixProduits[$produit->getId()] = $associer ? $associer->getPrix() : 'Prix non disponible';
        }
        return $this->render('recherche/results.html.twig', [
            'produits' => $produits,
            'query' => $query,
            'prixProduits' => $prixProduits,
        ]);
    }
}
