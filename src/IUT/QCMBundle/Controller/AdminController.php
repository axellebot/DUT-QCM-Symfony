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
}
