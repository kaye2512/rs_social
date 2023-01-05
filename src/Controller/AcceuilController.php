<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\Like;
use App\Entity\Share;
use App\Entity\User;
use App\Entity\Commentaire;
use App\Form\PostFormType;
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

class AcceuilController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]
    
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, PublicationRepository $publicaRepo, ManagerRegistry $doctrine): Response
    {
        
        //on récupére les publications
        $publications = $publicaRepo->findAll();

        //récupération de l'utilisateur connecté
        $user= $this->getUser();

        //créer une nouvelle publication
        $publication = new Publication();

        //récupération du formulaire
        $form = $this->createForm(PostFormType::class, $publication);

        //Traitement du formulaire
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            
            $publication = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('app_acceuil');
        }

        return $this->render('acceuil/index.html.twig', [
            'postForm' => $form->createView(),
            'user' => $user,
            'publications' => $publications,
            
        ]);
    }
    

   

}
