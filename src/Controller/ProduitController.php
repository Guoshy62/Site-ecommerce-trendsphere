<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TypeproduitRepository;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Entity\Associer;
use App\Repository\AssocierRepository;


class ProduitController extends AbstractController
{
    #[Route('/consulter/{type}', name: 'app_consulter')]
    public function consulter(Request $request,TypeproduitRepository $typeproduitRepository,ProduitRepository $ProduitRepository,AssocierRepository $associerRepository): Response
    {
        $type = $request->get('type'); 
        if (!$type) {
            return $this->redirectToRoute('app_accueil');
        } else {
            $typeProduit = $typeproduitRepository->findOneBy(array('libelle'=>$type));
            $produit = $ProduitRepository -> findAll();

            $prixProduits = [];
            foreach ($produit as $produit) {
            $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 8); 
            if (!$associer) {
                 $associer = $associerRepository->findByProduitAndTaille($produit->getId(), 15);
            }
            $prixProduits[$produit->getId()] = $associer ? $associer->getPrix() : 'Prix non disponible';
            }
        }
        return $this->render('produit/consulter.html.twig', [
            'typeProduit'=>$typeProduit,
            'produit'=>$produit,
            'prixProduits' => $prixProduits,
        ]);
       
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function article(Request $request,Produit $produit,AssocierRepository $associerRepository,Associer $associer): Response
    {
    $associers = $associerRepository->findByProduit($produit);
    $tailleOrdre = ['40','41','42','43','44','45','S', 'M', 'L', 'XL'];
    usort($associers, function($a, $b) use ($tailleOrdre) {
        $orderA = array_search($a->getTaille()->getLibelle(), $tailleOrdre);
        $orderB = array_search($b->getTaille()->getLibelle(), $tailleOrdre);
        return $orderA > $orderB ? 1 : -1;
    });
    $pricesBySize = [];

    foreach ($associers as $associer) {
        $size = $associer->getTaille()->getLibelle();
        $pricesBySize[$size] = $associer->getPrix();
    }
        return $this->render('produit/article.html.twig', [
            'produit'=>$produit,
            'associers'=>$associers,
            'pricesBySize' => $pricesBySize,
        ]);
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('gestion/mentions.html.twig', [
        ]);
    }
}
