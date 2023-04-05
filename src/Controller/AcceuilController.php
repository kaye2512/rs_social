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
    #[Route('/acceuil', name: 'app_acceuil')]
    public function index(
        PublicationRepository $postRepo,
        CommentaireRepository $commentaireRepo,
    ): Response {

        $publications = $postRepo->findAll();
        $user= $this->getUser();

        $comments = $commentaireRepo->findAll();

        return $this->render('acceuil/index.html.twig', [
            'publications' => $publications,
            'comments' => $comments
        ]);
    }


    #[Route('/profile', name: 'profiles')]
    public function profile(){

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


}
