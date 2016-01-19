<?php

namespace IUT\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questionnaire
 *
 * @ORM\Table(name="questionnaire")
 * @ORM\Entity(repositoryClass="IUT\QCMBundle\Repository\QuestionnaireRepository")
 */
class Questionnaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idAuteur", type="integer")
     */
    private $idAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @var array
     *
     * @ORM\OneToMany(
     *     targetEntity="Question",
     *     mappedBy="questionnaire",
     *     cascade={"remove", "persist"},
     *     fetch="EAGER"
     * )
     */
    private $questions;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get idAuteur
     *
     * @return int
     */
    public function getIdAuteur()
    {
        return $this->idAuteur;
    }

    /**
     * Set idAuteur
     *
     * @param integer $idAuteur
     *
     * @return Questionnaire
     */
    public function setIdAuteur($idAuteur)
    {
        $this->idAuteur = $idAuteur;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Questionnaire
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get questions
     *
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set questions
     *
     * @param string $questions
     *
     * @return Questionnaire
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \IUT\QCMBundle\Entity\Question $question
     *
     * @return Questionnaire
     */
    public function addQuestion(\IUT\QCMBundle\Entity\Question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \IUT\QCMBundle\Entity\Question $question
     */
    public function removeQuestion(\IUT\QCMBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }
}
