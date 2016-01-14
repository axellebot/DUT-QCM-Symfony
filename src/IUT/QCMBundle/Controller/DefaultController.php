<?php

namespace IUT\QCMBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")²
     */
    public function indexAction()
    {
        return $this->render('IUTQCMBundle:Default:index.html.twig');
    }
}
