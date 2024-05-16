<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\UserRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $contact->setDatedeenvoi(new \Datetime());
                $em->persist($contact);
                $em->flush();
                return $this->redirectToRoute('app_contact');
            }
        }
        return $this->render('gestion/contact.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact,
        ]);
    }

    #[Route('/liste-contacts', name: 'app_liste_contacts')]
    public function listeContacts(ContactRepository $contactRepository): Response
    {
        $contacts = $contactRepository->findAll();
        return $this->render('gestion/liste-contacts.html.twig', [
            'contacts' => $contacts
        ]);
    }

}
