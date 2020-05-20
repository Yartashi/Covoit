<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{

    /**
     * @Route("/inscription/index", name="inscription")
     */
    public function index()
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    /**
     * Lister tous les inscriptions.
     * @Route("/inscription", name="inscription.list")
     * @return Response
     */
    public function list() : Response
    {
    $inscriptions = $this->getDoctrine()->getRepository(Inscription::class)->findAll();
    return $this->render('inscription/list.html.twig', [
    'inscriptions' => $inscriptions,
    ]);
    }

    /**
     * Créer un nouveau inscription.
     * @Route("/nouveau-inscription/{idtrajet}", name="inscription.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Trajet $idtrajet
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em, Trajet $idtrajet) : Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (($idtrajet->calculerNbPlacesRestantes() - $inscription->getNbPassage()) > 0 )
            {
                $date = new \DateTime("+0 days");
                $inscription->setDateInscr($date);

                $utilisateur= new Utilisateur();
                $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
                $inscription->setUtilisateur($utilisateur);

                $inscription->setTrajet($idtrajet);

                $em->persist($inscription);
                $em->flush();
            }
            
            return $this->redirectToRoute("trajet.show",['id'=>$idtrajet->getId()]);
        }
        return $this->render('inscription/create.html.twig', [
        'form' => $form->createView(),'trajet' =>$idtrajet,
        ]);
    }

    /** 
    * @Route("/inscription/{id}/show", name="inscription.show")
    * @param Inscription $inscription
    * @return Response
    */
    public function show(inscription $inscription) : Response
    {
        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
            ]);
    }

    /**
    * Éditer un inscription.
    * @Route("inscription/{id}/edit", name="inscription.edit")
    * @param Request $request
    * @param EntityManagerInterface $em
    * @return RedirectResponse|Response
    */
    public function edit(Request $request, inscription $inscription, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (($inscription->getTrajet()->calculerNbPlacesRestantes() - $inscription->getNbPassage()) > 0 )
            {
                $em->flush();
            }
            return $this->redirectToRoute("trajet.show",['id'=>$inscription->getTrajet()->getId()]);
        }
        return $this->render('inscription/create.html.twig', [
        'form' => $form->createView(),'trajet' =>$inscription->getTrajet(),
        ]);
    }

    /**
    * Supprimer un inscription.
    * @Route("inscription/{id}/delete", name="inscription.delete")
    * @param Request $request
    * @param Inscription $inscription
    * @param EntityManagerInterface $em
    * @return Response
    */
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('inscription.delete', ['id' => $inscription->getId()]))
        ->getForm();
        $form->handleRequest($request);
        if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('inscription/delete.html.twig', [
            'inscription' => $inscription,
            'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($inscription);
        $em->flush();
        return $this->redirectToRoute("trajet.show",['id'=>$inscription->getTrajet()->getId()]);
    }
}
