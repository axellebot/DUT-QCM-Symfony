<?php

namespace IUT\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="IUT\QCMBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\ManyToOne(targetEntity="Questionnaire",inversedBy="questions")
     * @@ORM\JoinColumn(name="questionnaire_id",referencedColumnName="id")
     * @ORM\Column(name="idQuestionnaire", type="integer")
     */
    private $idQuestionnaire;

    /**
     * @var int
     *
     * @ORM\Column(name="bareme", type="integer")
     */
    private $bareme;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;


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
     * Get id
     *
     * @return int
     */
    public function getIdQuestionnaire()
    {
        return $this->idQuestionnaire;
    }

    /**
     * Set idQuestionnaire
     *
     * @param integer $idQuestionnaire
     *
     * @return Question
     */
    public function setIdQuestionnaire($idQuestionnaire)
    {
        $this->idQuestionnaire = $idQuestionnaire;

        return $this;
    }

    /**
     * Get bareme
     *
     * @return int
     */
    public function getBareme()
    {
        return $this->bareme;
    }

    /**
     * Set bareme
     *
     * @param integer $bareme
     *
     * @return Question
     */
    public function setBareme($bareme)
    {
        $this->bareme = $bareme;

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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Question
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }
}

