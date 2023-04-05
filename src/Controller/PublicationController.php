<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\UX\Turbo\TurboBundle;



class PublicationController extends AbstractController
{
    #[Route('/new_post', name: 'app_new_post', methods: ['get', 'post'])]
    public function new_publication(
        Request $request,
        EntityManagerInterface $entityManager)
    {
        $data = $request->query->get('post');
        $user= $this->getUser();
        //on crée une nouvelle publication
        $publication = new Publication();
        $userId = $user ->getId("user_id");

        $userid = $entityManager->getRepository(User::class)->find($userId);
        // on définit l'identifiant du publieur dans la bdd
        $publication->setUser($userid);
        $publication->setPost($data);
        $publication->setCreateAt(new DateTime());

        //on persist et flush dans la bdd
        $entityManager->persist($publication);
        $entityManager->flush();

        return $this->redirectToRoute('app_acceuil');
    }

     /* #[Route('/like/{id}', name: 'post_like', methods: ['get', 'post'])]
    public function like(Publication $publication, EntityManagerInterface $em, Request $request)
    {
        //On récupére l'utilisateur connecté
        $user = $this->getUser()->getUserIdentifier();
        $liked = false;

        //On commence à chercher s'il y'a des likes

        //On cherche si l'utilisateur a déja liké le post
        foreach ($publication->getLikes() as $liker) {
            if ($liker['liker'] == $user) {
                $liked = true;
                $publication = $publication->unlike($user);
            }
        }


        if (!$liked) {
            //On définit l'utilisateur qui a liké dans la bdd
            $publication->setLikes(['liker' => $user]);
        }



        //On enregistre dans la bdd
        $em->persist($publication);
        $em->flush();

        $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
        return $this->render('like/like.stream.html.twig', ['publication' => $publication]);
    }*/

}