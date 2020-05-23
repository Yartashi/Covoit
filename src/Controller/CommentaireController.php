<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire/index", name="commentaire")
     */
    public function index()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }
    

    /**
     * Lister tous les commentaires.
     * @Route("/commentaire", name="commentaire.list")
     * @return Response
     */
    public function list() : Response
    {
    $commentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();
    return $this->render('commentaire/list.html.twig', [
    'commentaires' => $commentaires,
    ]);
    }

    /**
     * Créer un nouveau commentaire.
     * @Route("/nouveau-commentaire/{idtrajet}", name="commentaire.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Trajet $idtrajet
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em,Trajet $idtrajet) : Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime("+0 days");
            $commentaire->setDateComm($date);

            $utilisateur= new Utilisateur();
            $utilisateur = $this->getUser();
            $commentaire->setUtilisateur($utilisateur);

            $commentaire->setTrajet($idtrajet);

            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute("trajet.show",['id'=>$idtrajet->getId()]);
        }
        return $this->render('commentaire/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /** 
    * @Route("/commentaire/{id}/show", name="commentaire.show")
    * @param Commentaire $commentaire
    * @return Response
    */
    public function show(Commentaire $commentaire) : Response
    {
        return $this->render('commentaire/show.html.twig', [
            'commentaire' => $commentaire,
            ]);
    }

    /**
    * Éditer un commentaire.
    * @Route("commentaire/{id}/edit", name="commentaire.edit")
    * @param Request $request
    * @param EntityManagerInterface $em
    * @return RedirectResponse|Response
    */
    public function edit(Request $request, Commentaire $commentaire, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        $utilisateur= new Utilisateur();
        $utilisateur = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            if($commentaire->getUtilisateur()->getId() === $utilisateur->getId())
            {
                $em->flush();
            }
           
            return $this->redirectToRoute("trajet.show",['id'=>$commentaire->getTrajet()->getId()]);
        }
        return $this->render('commentaire/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /**
    * Supprimer un commentaire.
    * @Route("commentaire/{id}/delete", name="commentaire.delete")
    * @param Request $request
    * @param Commentaire $commentaire
    * @param EntityManagerInterface $em
    * @return Response
    */
    public function delete(Request $request, Commentaire $commentaire, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('commentaire.delete', ['id' => $commentaire->getId()]))
        ->getForm();
        $form->handleRequest($request);
        
        $utilisateur= new Utilisateur();
        $utilisateur = $this->getUser();

        if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('commentaire/delete.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        if( $commentaire->getUtilisateur()->getId() === $utilisateur->getId() || in_array('ROLE_ADMIN',$utilisateur->getRoles()) )
            {
                $em->remove($commentaire);
                $em->flush();
            }
        return $this->redirectToRoute("trajet.show",['id'=>$commentaire->getTrajet()->getId()]);
    }
}
