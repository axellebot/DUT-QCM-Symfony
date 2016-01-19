<?php

namespace IUT\QCMBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IUT\QCMBundle\Entity\User;
use IUT\QCMBundle\Entity\UserType;

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('IUTQCMBundle:User')
            ->findAll();

        return $this->render('IUTQCMBundle:admin:index.html.twig', array('users' => $users));
    }

    /**
     * @Route("/admin/user/{id}/delete", name="delete_user", requirements={"id" = "\d+"})
     * @param $id
     * @return redirect
     */
    public function deleteUser($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('IUTQCMBundle:User')->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirect('/admin');
    }


    /**
     * @Route("/admin/user/{id}/modify", name="modify_user", requirements={"id" = "\d+"})
     * @param $id
     * @return redirect
     */
    public function modifyUser($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('IUTQCMBundle:User')->find($id);

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $role = $user->getRole();

        $messageFirstname = null;
        $messageLastname = null;
        $messageUsername = null;
        $messageEmail = null;
        $messageRole = null;
        $messageGlobal = null;


        if ($request->getMethod() == 'POST') {
            $postFirstname = $request->request->get('_firstname');
            $postLastname = $request->request->get('_lastname');
            $postUsername = $request->request->get('_username');
            $postEmail = $request->request->get('_email');
            $postRole = $request->request->get('_role');

            switch ($postRole) {
                case"admin":
                    $postRole = "A";
                    break;
                case "prof":
                    $postRole = "P";
                    break;
                case "eleve":
                    $postRole = "E";
                    break;
                default:
                    $postRole = "E";
                    break;
            }
            if ($postFirstname != $firstname || $postLastname != $lastname || $postUsername != $username || $postEmail != $email || $postRole != $role) {
                if ($postFirstname != $firstname) {
                    $user->setFirstname($postFirstname);
                    $messageFirstname = "Prénom modifié";
                }
                if ($postUsername != $username) {
                    $user->setLastname($postLastname);
                    $messageLastname = "Nom modifié";
                }
                if ($postUsername != $username) {
                    //souhaite changer son username
                    $user->setUsername($postUsername);
                    $messageUsername = "Pseudo modifié";
                }
                if ($postEmail != $email) {
                    //souhaite changer son mail
                    $user->setEmail($postEmail);
                    $messageEmail = "Mail modifié";
                }
                if ($postRole != $role) {
                    //souhaite changer son role
                    $user->setRole($postRole);
                    $messageRole = "Role modifié";
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
                        'IUTQCMBundle:admin:userProfile.html.twig',
                        array(
                            'user' => $user,
                            'messageFirstname' => null,
                            'messageLastname' => null,
                            'messageUsername' => null,
                            'messageEmail' => null,
                            'messageRole' => null,
                            'messageGlobal' => $messageGlobal,
                        )
                    );
                }
            } else {
                $messageGlobal = "Aucun changement à appliquer changement";
            }
        }


        return $this->render(
            'IUTQCMBundle:admin:userProfile.html.twig',
            array(
                'user' => $user,
                'messageFirstname' => $messageFirstname,
                'messageLastname' => $messageLastname,
                'messageUsername' => $messageUsername,
                'messageEmail' => $messageEmail,
                'messageRole' => $messageRole,
                'messageGlobal' => $messageGlobal,
            )
        );
    }
}
