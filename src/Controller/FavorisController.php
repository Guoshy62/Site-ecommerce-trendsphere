<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;

class FavorisController extends AbstractController
{
    #[Route('/private-favoris-produit/{id}', name: 'app_favoris_produit')]
    public function favoris(Produit $produit,EntityManagerInterface $em,Request $request): Response
    {
       if ($this->getUser()->getfavoris()->contains($produit)) {
        $this->getUser()->removeFavori($produit);
       } else {
        $this->getUser()->addfavori($produit);
       }
       $em->persist($this->getUser());
       $em->flush();
       $referer = $request->headers->get('referer');
       return $this->redirect($referer);
    }

    #[Route('/private-suppfavoris/{id}', name: 'app_suppfav')]
    public function suppfav(Produit $produit,EntityManagerInterface $em,Request $request): Response
    {
        if ($this->getUser()->getfavoris()->contains($produit)) {
            $this->getUser()->removeFavori($produit);
        }
        $em->persist($this->getUser());
        $em->flush();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    #[Route('/private-listeFav', name: 'app_listefav')]
    public function listefav(): Response
    {
     
        return $this->render('favoris/favoris.html.twig', [
            
        ]);

    }
}
