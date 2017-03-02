<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/signup", name="app_signup")
     * @Method("GET|POST")
     */
    public function signupAction(Request $request)
    {
        $player = new Player();

        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $player = $form->getData();

            //encode password
            $encoder = $this->get('security.password_encoder');
            $encodedPwd = $encoder->encodePassword($player, $player->getRawPassword());
            $player->setPassword($encodedPwd);

            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Player is now registered');
            return $this->redirectToRoute('app_login');
        }


        return $this->render('user/signup.html.twig', array(
            'form' => $form->createView()));
    }
}
