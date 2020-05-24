<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/{_locale}/languutilisateur/index", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * Lister tous les utilisateurs.
     * @Route("/{_locale}/admin/utilisateur", name="utilisateur.list")
     * @return Response
     */
    public function list() : Response
    {
        $utilisateurs = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        return $this->render('utilisateur/list.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * Créer un nouvel utilisateur.
     * @Route("/{_locale}/nouveau-utilisateur", name="utilisateur.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $utilisateur = new utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/{_locale}/utilisateur/{id}/show", name="utilisateur.show")
     * @param Utilisateur $utilisateur
     * @return Response
     */
    public function show(Utilisateur $utilisateur) : Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * Éditer un utilisateur.
     * @Route("/{_locale}/utilisateur/{id}/edit", name="utilisateur.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un utilisateur.
     * @Route("/{_locale}/utilisateur/{id}/delete", name="utilisateur.delete")
     * @param Request $request
     * @param Utilisateur $utilisateur
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur.delete', ['id' => $utilisateur->getId()]))
            ->getForm();
        $form->handleRequest($request);
        if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('utilisateur/delete.html.twig', [
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();
        return $this->redirectToRoute('utilisateur.list');
    }

    public function __toString(): string
    {
        return 'Utilisateur';
    }


    /**
     * Lister tous les trajets créés par l'utilisateur.
     * @Route("/{_locale}/utilisateur-trajets", name="utilisateur-trajets.list")
     * @return Response
     */
    public function listTrajets() : Response
    {
        $utilisateur = $this->getUser();
        return $this->render('trajet/list.html.twig', [
            'trajets' => $utilisateur->getTrajets(),
        ]);
    }

    /**
     * Lister tous les trajets auxquels l'utilisateur s'est inscrit.
     * @Route("/{_locale}/utilisateur-inscriptions", name="utilisateur-inscriptions.list")
     * @return Response
     */
    public function listInscriptions() : Response
    {
        $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
        return $this->render('inscription/list.html.twig', [
            'inscriptions' => $utilisateur->getInscriptions(),
        ]);
    }

}
