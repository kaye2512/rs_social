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

class AcceuilController extends AbstractController
{
    #[Route('/acceuil', name: 'acceuil_')]
    
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, PublicationRepository $publicaRepo, ManagerRegistry $doctrine): Response
    {
        
        //on récupére les publications
        $publications = $publicaRepo->findAll();

        //récupération de l'utilisateur connecté
        $user= $this->getUser();

        //récupérer les publications de l'utilisateur connecté
        $pubUser =  $publicaRepo->findBy(['id' => $user->getId()]); 
        
        $commUser = $pubUser[0]->getCommentaires();
        //créer une nouvelle publication
        $publication = new Publication();

        //récupération du formulaire
        $form = $this->createForm(PostFormType::class, $publication);

        //Traitement du formulaire post
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            //envoi de la date
            $publication->setCreateAt(new DateTime());
            // on recupère l'utilisateur correspondant
            $userid = $user ->getId("user_id");
            // on va chercher utilisateur corespondant
            $usid = $entityManager->getRepository(User::class)->find($userid);
    
            $publication->setUser($usid);
            // on recupere le message saisi
            $publication = $form->getData();
            // on envoie les informations dans la base de donnée
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('acceuil_');
        }


        return $this->render('acceuil/index.html.twig', [
            'postForm' => $form->createView(),
            'publications' => $publications
            
        ]);
    }


    #[Route('/profile', name: 'profiles')]

    public function profile(){
        
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


}
