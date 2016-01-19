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
     * @var Questionnaire
     *
     * @ORM\ManyToOne(
     *     targetEntity="Questionnaire",
     *     inversedBy="questions"
     * )
     * @ORM\JoinColumn(
     *     name="questionnaireId",
     *     referencedColumnName="id",
     *     nullable=false
     * )
     */
    private $questionnaire;

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
     * @var array
     *
     * @ORM\OneToMany(
     *     targetEntity="Reponse",
     *     mappedBy="question",
     *     cascade={"remove", "persist"},
     *     fetch="EAGER"
     * )
     */
    private $reponses;


    /**
     * @var array
     *
     * @ORM\OneToMany(
     *     targetEntity="ReponseUser",
     *     mappedBy="question",
     *     cascade={"remove", "persist"},
     *     fetch="EAGER"
     * )
     */
    private $reponsesUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Add reponse
     *
     * @param \IUT\QCMBundle\Entity\Reponse $reponse
     *
     * @return Question
     */
    public function addReponse(\IUT\QCMBundle\Entity\Reponse $reponse)
    {
        $reponse->setQuestion($this);

        $this->reponses[] = $reponse;

        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \IUT\QCMBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\IUT\QCMBundle\Entity\Reponse $reponse)
    {
        $this->reponses->removeElement($reponse);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Add reponsesUser
     *
     * @param \IUT\QCMBundle\Entity\ReponseUser $reponsesUser
     *
     * @return Question
     */
    public function addReponsesUser(\IUT\QCMBundle\Entity\ReponseUser $reponsesUser)
    {
        $this->reponsesUser[] = $reponsesUser;

        return $this;
    }

    /**
     * Remove reponsesUser
     *
     * @param \IUT\QCMBundle\Entity\ReponseUser $reponsesUser
     */
    public function removeReponsesUser(\IUT\QCMBundle\Entity\ReponseUser $reponsesUser)
    {
        $this->reponsesUser->removeElement($reponsesUser);
    }

    /**
     * Get reponsesUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponsesUser()
    {
        return $this->reponsesUser;
    }

    /**
     * Set questionnaire
     *
     * @param \IUT\QCMBundle\Entity\Questionnaire $questionnaire
     *
     * @return Question
     */
    public function setQuestionnaire(\IUT\QCMBundle\Entity\Questionnaire $questionnaire = null)
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return \IUT\QCMBundle\Entity\Questionnaire
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }
}
