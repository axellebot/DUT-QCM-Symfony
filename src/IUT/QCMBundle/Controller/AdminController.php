<?php

namespace IUT\QCMBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @Route("/admin/user/{id}/delete", name="delete_questionnaire", requirements={"id" = "\d+"})
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
     * @Route("/admin/user/{id}/modify", name="delete_questionnaire", requirements={"id" = "\d+"})
     * @param $id
     */
}
