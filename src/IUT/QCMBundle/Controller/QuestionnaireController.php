<?php

namespace IUT\QCMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionnaireController extends Controller
{
    public function addAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
