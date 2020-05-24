<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/{_locale}/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérer la redirection
         if ($this->getUser()) {
             return $this->redirectToRoute('homeLangue', array('_locale'=>$this->getUser()->getLangueChoix()));
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/{_locale}/logout", name="app_logout")
     * @param string string $_locale
     */
    public function logout(TokenStorageInterface $tokenStorage, string $_locale)
    {
        $tokenStorage->setToken(null);
        return $this->redirectToRoute('app_login', array('_locale'=>$_locale));
    }
}
