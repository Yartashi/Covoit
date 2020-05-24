<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Inscription;
use App\Repository\CommentaireRepository;
use App\Repository\InscriptionRepository;
use App\Repository\TrajetRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param TrajetRepository $repoTrajet
     * @param UtilisateurRepository $repoUtilisateur
     * @param CommentaireRepository $repoCommentaire
     * @param InscriptionRepository $repoInscription
     * @return Response
     */
    public function index(TrajetRepository $repoTrajet,UtilisateurRepository $repoUtilisateur,CommentaireRepository $repoCommentaire,InscriptionRepository $repoInscription):Response
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
    
    /**
     * @Route("/{_locale}/home", name="homeLangue")
     * @param TrajetRepository $repoTrajet
     * @param UtilisateurRepository $repoUtilisateur
     * @param CommentaireRepository $repoCommentaire
     * @param InscriptionRepository $repoInscription
     * @return Response
     */
    public function indexLangue(TrajetRepository $repoTrajet,UtilisateurRepository $repoUtilisateur,CommentaireRepository $repoCommentaire,InscriptionRepository $repoInscription):Response
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
