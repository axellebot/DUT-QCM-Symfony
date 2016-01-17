<?php
/**
 * Created by PhpStorm.
 * User: Ilias
 * Date: 15/01/2016
 * Time: 15:00
 */

namespace IUT\QCMBundle\Controller;

use IUT\QCMBundle\Entity\Question;
use IUT\QCMBundle\Entity\Reponse;
use IUT\QCMBundle\Form\QuestionnaireType;
use IUT\QCMBundle\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionController extends Controller
{
    /**
     * @Route("/add/{id}", name="add_question", requirements={"id" = "\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request, $id)
    {
        $question = new Question();
        //$question->addReponse(new Reponse());
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request->request->get('reponse[]', 'default value if bar does not exist');
            $question->setIdQuestionnaire($id);

            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            //return $this->redirect('/');
        }
        return $this->render(
            '@IUTQCM/Default/question_add.html.twig',
            array('form' => $form->createView())
        );
    }
}