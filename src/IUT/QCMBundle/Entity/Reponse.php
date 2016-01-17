<?php

namespace IUT\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="IUT\QCMBundle\Repository\ReponseRepository")
 */
class Reponse
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
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var bool
     *
     * @ORM\Column(name="correcte", type="boolean")
     */
    private $correcte;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(
     *     targetEntity="Question",
     *     inversedBy="reponses"
     * )
     * @ORM\JoinColumn(
     *     name="questionId",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    private $question;


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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Reponse
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set correcte
     *
     * @param boolean $correcte
     *
     * @return Reponse
     */
    public function setCorrecte($correcte)
    {
        $this->correcte = $correcte;

        return $this;
    }

    /**
     * Get correcte
     *
     * @return bool
     */
    public function getCorrecte()
    {
        return $this->correcte;
    }

    /**
     * Set question
     *
     * @param \IUT\QCMBundle\Entity\Question $question
     *
     * @return Reponse
     */
    public function setQuestion(\IUT\QCMBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \IUT\QCMBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
