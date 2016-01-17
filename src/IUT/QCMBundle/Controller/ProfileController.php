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

                if ($postNewPasswordFirst != "" || $postNewPasswordSecond != "" || $postUsername != $username || $postEmail != $email) {
                    if ($postPassword == $postNewPasswordFirst) {
                        $message = "Le mot de passe doit être différent !";
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
                    if ($postNewPasswordFirst != null && $postNewPasswordSecond != null) {
                        //souhaite modifier son mdp
                        if ($postNewPasswordFirst == $postNewPasswordSecond) {
                            $user->setPassword($encoder->encodePassword($user, $postNewPasswordFirst));
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
                        $user->setEmail($postEmail);
                    }
                    if ($postUsername != $username) {
                        //souhaite changer son username
                        $user->setUsername($postUsername);
                    }
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($user);

                    try {
                        $manager->flush();
                    } catch (\Exception $e) {
                        $msg = '### Message ### \n' . $e->getMessage() . '\n### Trace ### \n' . $e->getTraceAsString();
                        $this->container->get('logger')->critical($msg);
                        // Here put you logic now you now that the flush has failed and all subsequent flush will fail as well
                        $message="Pseudo ou E-mail déjà utilisé";
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

                    $username = $user->getUsername();
                    $email = $user->getEmail();

                    $message = "Changé !";
                } else {
                    $message = "Auncun changement";
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