<?php

namespace IUT\QCMBundle\Controller;

use IUT\QCMBundle\Entity\Questionnaire;
use IUT\QCMBundle\Form\QuestionnaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionnaireController extends Controller
{
    /**
     * @Route("/add", name="add_questionnaire")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $questionnaire->setIdAuteur(-1);
            $questionnaire->setQuestions('test');

            $em = $this->getDoctrine()->getManager();
            $em->persist($questionnaire);
            $em->flush();

            return $this->redirect($this->generateUrl('add_question', array(
                'id' => $questionnaire->getId()
            )));
        }
        return $this->render(
            '@IUTQCM/Default/questionnaire_add.html.twig',
            array('form' => $form->createView())
        );
    }
}
