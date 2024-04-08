<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TypeproduitRepository;

class ProduitController extends AbstractController
{
    #[Route('/consulter/{type}', name: 'app_consulter')]
    public function consulter(Request $request,TypeproduitRepository $typeproduitRepository): Response
    {
        $type = $request->get('type'); 
        if (!$type) {
            return $this->redirectToRoute('app_accueil');
        } else {
            $typeProduit = $typeproduitRepository->findOneBy(array('libelle'=>$type));
        }
        return $this->render('produit/consulter.html.twig', [
            'typeProduit'=>$typeProduit
        ]);
    }
}
