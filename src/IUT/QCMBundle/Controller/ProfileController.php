<?php

namespace IUT\QCMBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IUT\QCMBundle\Entity\User;
use IUT\QCMBundle\Entity\UserType;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="user_profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function profileAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_FULLY') || !$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect("/login");
        }


        $user = $this->getUser();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $message = null;


        if ($request->getMethod() == 'POST') {
            $postUsername = $request->request->get('_username');
            $postEmail = $request->request->get('_email');
            $postPassword = $request->request->get('_password');
            $postNewPasswordFirst = $request->request->get('_newPasswordFirst');
            $postNewPasswordSecond = $request->request->get('_newPasswordSecond');


            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            if ($encoder->isPasswordValid($password, $postPassword, $user->getSalt())) {
                //autoriser les modification
                if ($postNewPasswordFirst != null && $postNewPasswordSecond != null) {
                    //souhaite modifier son mdp
                    if ($postNewPasswordFirst == $postNewPasswordSecond) {

                    } else {
                        $message = "Les mots de passe ne correspondent pas !";
                        return $this->render(
                            'IUTQCMBundle:security:profile.html.twig',
                            array(
                                // last username entered by the user
                                'username' => $username,
                                'email' => $email,
                                'message' => $message,
                            )
                        );
                    }
                }
                if ($postEmail != $email) {
                    //souhaite changer son mdp
                }
                if ($postUsername != $username) {
                    //souhaite changer son username
                }
            } else {
                $message = "Mauvais mot de passe";
            }

        }

        return $this->render(
            'IUTQCMBundle:security:profile.html.twig',
            array(
                // last username entered by the user
                'username' => $username,
                'email' => $email,
                'message' => $message,
            )
        );
    }

}