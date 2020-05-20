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
     * @Route("/utilisateur/index", name="utilisateur")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * Lister tous les utilisateurs.
     * @Route("/admin/utilisateur", name="utilisateur.list")
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
     * @Route("/nouveau-utilisateur", name="utilisateur.create")
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
            return $this->redirectToRoute('utilisateur.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/{id}/show", name="utilisateur.show")
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
     * @Route("utilisateur/{id}/edit", name="utilisateur.edit")
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
            return $this->redirectToRoute('utilisateur.list');
        }
        return $this->render('utilisateur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprimer un utilisateur.
     * @Route("utilisateur/{id}/delete", name="utilisateur.delete")
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
}
