<?php

namespace IUT\QCMBundle\Controller;

use IUT\QCMBundle\Entity\Question;
use IUT\QCMBundle\Entity\Questionnaire;
use IUT\QCMBundle\Entity\Reponse;
use IUT\QCMBundle\Entity\ReponseUser;
use IUT\QCMBundle\Entity\User;
use IUT\QCMBundle\Form\QuestionnaireType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_PROF')) {
            return $this->redirect('/');
        }
        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw $this->createAccessDeniedException();
            }

            $user = $this->getUser();
            $questionnaire->setIdAuteur($user->getId());

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

    /**
     * @Route("/delete/{id}", name="add_questionnaire")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $questionnaire = $em->getRepository('IUTQCMBundle:Questionnaire')->find($id);

        try {
            $em->remove($questionnaire);
            $em->flush();
        }catch(\Exception $e){
        }

        return $this->redirect('/');
    }

    /**
     * @Route("/answer/{id}", name="answer_questionnaire", requirements={"id" = "\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function answerAction(Request $request, $id)
    {
        $questionnaire = $this->getDoctrine()->getManager()->getRepository('IUTQCMBundle:Questionnaire')->find($id);
        /** @var Question $question */
        $question = $this->getDoctrine()
            ->getRepository('IUTQCMBundle:Question')
            ->createQueryBuilder('q')
            ->leftJoin("IUTQCMBundle:ReponseUser", "ru", "WITH", "q.id = ru.question")
            ->where('q.questionnaire = :id')
            ->setParameter('id', $questionnaire->getId())
            ->andWhere('ru.question IS NULL')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
        if ($question != null) {
            if ($request->getMethod() == 'POST') {
                $keys = $request->request->keys();
                if (count($keys) > 1) {
                    foreach ($keys as $key) {
                        if (is_int($key)) {
                            $reponseUser = new ReponseUser();
                            $reponseUser->setQuestion($question);
                            $reponseUser->setChoix($key);
                            $reponseUser->setEleve($this->getUser());

                            $em = $this->getDoctrine()->getManager();
                            $em->persist($reponseUser);
                            $em->flush();
                        }
                    }
                    return $this->redirect($this->generateUrl('answer_questionnaire', array(
                        'id' => $id
                    )));
                }
            }

            return $this->render('@IUTQCM/Default/questionnaire_answer.html.twig', array(
                'questionnaire' => $questionnaire,
                'question' => $question,
            ));
        }
        return $this->render('@IUTQCM/Default/questionnaire_end.html.twig', array(
            'questionnaire' => $questionnaire,
        ));
    }
}
