<?php

namespace App\Controller;
use App\Entity\Trajet;
use App\Entity\Utilisateur;
use App\Form\TrajetSearchType;
use App\Form\TrajetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrajetRepository;

/* NE FAIT RIEN DU TOUT
* @Route("/{_locale}/")
*/

class TrajetController extends AbstractController
{
    /**
     * @Route("/{_locale}/trajet/index", name="trajet")
     */
    public function index()
    {
        return $this->render('trajet/index.html.twig', [
            'controller_name' => 'TrajetController',
        ]);
    }

    /**
     * Lister tous les trajets.
     * @Route("/{_locale}/trajet", name="trajet.list")
     * @return Response
     */
    public function list() : Response
    {
    $trajets = $this->getDoctrine()->getRepository(Trajet::class)->findAll();
    return $this->render('trajet/list.html.twig', [
    'trajets' => $trajets,
    ]);
    }

    /**
     * Créer un nouveau trajet.
     * @Route("/{_locale}/nouveau-trajet", name="trajet.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $trajet = new Trajet();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur= new Utilisateur;
            $utilisateur = $this->getUser();
            $trajet->setConducteurId($utilisateur);
            $em->persist($trajet);
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('trajet/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /** 
    * @Route("/{_locale}/trajet/{id}/show", name="trajet.show")
    * @param Trajet $trajet
    * @return Response
    */
    public function show(Trajet $trajet) : Response
    {
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
            ]);
    }

    /**
    * Éditer un trajet.
    * @Route("/{_locale}/trajet/{id}/edit", name="trajet.edit")
    * @param Request $request
    * @param EntityManagerInterface $em
    * @return RedirectResponse|Response
    */
    public function edit(Request $request, Trajet $trajet, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('trajet.list');
        }
        return $this->render('trajet/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

    /**
    * Supprimer un trajet.
    * @Route("/{_locale}/trajet/{id}/delete", name="trajet.delete")
    * @param Request $request
    * @param Trajet $trajet
    * @param EntityManagerInterface $em
    * @return Response
    */
    public function delete(Request $request, Trajet $trajet, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('trajet.delete', ['id' => $trajet->getId()]))
        ->getForm();
        $form->handleRequest($request);
        if ( ! $form->isSubmitted() || ! $form->isValid()) {
            return $this->render('trajet/delete.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($trajet);
        $em->flush();
        return $this->redirectToRoute('trajet.list');
    }


    /**
     * Chercher un trajet.
     * @Route("/{_locale}/search-trajet", name="trajet.search")
     * @param TrajetRepository $repo
     * @param Request $request
     * @return Response
     */
    public function search(TrajetRepository $repo,Request $request) : Response
    { 
        $trajet= new Trajet();
        $form = $this->createForm(TrajetSearchType::class,$trajet);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $trajets = $repo->searchTrajets($trajet);
            
            return $this->render('trajet/list.html.twig', [
                'trajets' => $trajets,
                ]);
        }
        return $this->render('trajet/search.html.twig', [
        'form' => $form->createView(),
        ]);
    }
}
