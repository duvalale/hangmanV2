<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="app_login")
     * @Method("GET")
     */
    public function loginAction(Request $request)
    {
        if ($this->getUser()) {
            // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
            return $this->redirectToRoute('app_edit');
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/login", name="app_login_check")
     * @Method("POST")
     */
    public function loginCheckAction()
    {
        // this action will never be executed
    }

    /**
     * @Route("/logout", name="app_logout")
     * @Method("GET")
     */
    public function logoutAction()
    {
        // this action will never be executed
    }
}
