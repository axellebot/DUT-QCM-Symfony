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
    public function modifyUser($id ,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('IUTQCMBundle:User')->find($id);

        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $username = $user->getUsername();
        $email = $user->getEmail();

        $messageFirstname = null;
        $messageLastname = null;
        $messageUsername = null;
        $messageEmail = null;
        $messageGlobal = null;


        if ($request->getMethod() == 'POST') {
            $em->remove($user);
            $em->flush();
        }



        return $this->render(
            'IUTQCMBundle:admin:userProfile.html.twig',
            array(
                'user'=>$user,
                'messageFirstname' => $messageFirstname,
                'messageLastname' => $messageLastname,
                'messageUsername' => $messageUsername,
                'messageEmail' => $messageEmail,
                'messageGlobal' => $messageGlobal,
            )
        );    }
}
