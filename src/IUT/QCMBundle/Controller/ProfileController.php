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
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $messageFirstname = null;
        $messageLastname = null;
        $messageUsername = null;
        $messageEmail = null;
        $messagePassword = null;
        $messageNewPassword = null;
        $messageGlobal = null;


        if ($request->getMethod() == 'POST') {
            $postFirstname = $request->request->get('_firstname');
            $postLastname = $request->request->get('_lastname');
            $postUsername = $request->request->get('_username');
            $postEmail = $request->request->get('_email');
            $postPassword = $request->request->get('_password');
            $postNewPasswordFirst = $request->request->get('_newPasswordFirst');
            $postNewPasswordSecond = $request->request->get('_newPasswordSecond');


            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            if ($encoder->isPasswordValid($password, $postPassword, $user->getSalt())) {
                //autoriser les modification
                if ($postFirstname != $firstname || $postLastname != $lastname || $postNewPasswordFirst != "" || $postNewPasswordSecond != "" || $postUsername != $username || $postEmail != $email) {
                     if ($postFirstname != $firstname) {
                        $user->setFirstname($postFirstname);
                        $messageFirstname = "Prénom modifié";
                    }
                    if ($postUsername != $username) {
                        $user->setLastname($postLastname);
                        $messageLastname = "Nom modifité";
                    }
                    if ($postUsername != $username) {
                        //souhaite changer son username
                        $user->setUsername($postUsername);
                        $messageUsername = "Pseudo modifité";
                    }
                    if ($postEmail != $email) {
                        //souhaite changer son mail
                        $user->setEmail($postEmail);
                        $messageEmail = "Mail modifié";
                    }
                    if ($postNewPasswordFirst != null && $postNewPasswordSecond != null) {
                        //souhaite modifier son mdp
                        if ($postNewPasswordFirst == $postNewPasswordSecond) {
                            $user->setPassword($encoder->encodePassword($user, $postNewPasswordFirst));
                        } else {
                            $messageNewPassword = "Les mots de passe ne correspondent pas !";
                        }
                    }

                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($user);

                    try {
                        $manager->flush();
                    } catch (\Exception $e) {
                        $msg = '### Message ### \n' . $e->getMessage() . '\n### Trace ### \n' . $e->getTraceAsString();
                        $this->container->get('logger')->critical($msg);
                        // Here put you logic now you now that the flush has failed and all subsequent flush will fail as well
                        $messageGlobal = "Pseudo ou E-mail déjà utilisé";
                        return $this->render(
                            'IUTQCMBundle:security:profile.html.twig',
                            array(
                                'messageFirstname' => null,
                                'messageLastname' => null,
                                'messageUsername' => null,
                                'messageEmail' => null,
                                'messagePassword' => null,
                                'messagePassword' => null,
                                'messageGlobal' => $messageGlobal,
                            )
                        );
                    }
                } else {
                    $messageGlobal = "Aucun changement à appliquer changement";
                }
            } else {
                $messagePassword = "Mauvais mot de passe";
            }
        }

        return $this->render(
            'IUTQCMBundle:security:profile.html.twig',
            array(
                'messageFirstname' => $messageFirstname,
                'messageLastname' => $messageLastname,
                'messageUsername' => $messageUsername,
                'messageEmail' => $messageEmail,
                'messagePassword' => $messagePassword,
                'messageNewPassword' => $messageNewPassword,
                'messageGlobal' => $messageGlobal,
            )
        );
    }

}