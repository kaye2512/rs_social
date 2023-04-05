<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\User;
use App\Entity\Commentaire;
use App\Form\PostFormType;
use App\Form\CommentFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\PublicationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
use App\Repository\CommentaireRepository;

class CommentaireController extends AbstractController
{
    #[Route('/comment/newcomment/{id}', name: 'app_comment', methods: ['GET','POST'])]
    
    public function comment(
                          Request $request,
                          Publication $publication,
                          EntityManagerInterface $entityManager,
                          SluggerInterface $slugger,
                          PublicationRepository $publicaRepo,
                          ManagerRegistry $doctrine
    )
    {

        $message =$request->query->get("messages");

        //récupération de l'utilisateur connecté
        $user= $this->getUser();

        // on crée un nouveau commentaire
        $commentaire = new Commentaire();

        $commentaire->setUser($user);
        $commentaire->setPost($publication);
        $commentaire->setMessages($message);


        //on envoie les informations dans la base
         $entityManager->persist($commentaire);
         $entityManager->flush();

         //a ajouter après avoir fais la partie demande d'amis
        return $this->redirectToRoute('app_acceuil');
    }


    #[Route('/profile', name: 'profiles')]

    public function profile(){
        
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


}
