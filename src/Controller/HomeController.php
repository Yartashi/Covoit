<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Inscription;
use App\Repository\CommentaireRepository;
use App\Repository\InscriptionRepository;
use App\Repository\TrajetRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(TrajetRepository $repoTrajet,UtilisateurRepository $repoUtilisateur,CommentaireRepository $repoCommentaire,InscriptionRepository $repoInscription)
    {
        $trajets = $repoTrajet->last5Trajets();
        $utilisateurs = $repoUtilisateur->last5Utilisateur();
        $commentaires = $repoCommentaire->last5Commentaire();
        $inscriptions = $repoInscription->last5Inscription();
        return $this->render('home/index.html.twig', [
            'trajets' => $trajets,
            'utilisateurs' => $utilisateurs,
            'commentaires' => $commentaires,
            'inscriptions' => $inscriptions,
        ]);
    }
}
