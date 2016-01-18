<?php

namespace IUT\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponseUser")
 * @ORM\Entity(repositoryClass="IUT\QCMBundle\Repository\ReponseRepository")
 */
class ReponseUser
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
     * @var bool
     *
     * @ORM\Column(name="choix", type="integer")
     */
    private $choix;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(
     *     targetEntity="Question",
     *     inversedBy="reponsesUser"
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set choix
     *
     * @param integer $choix
     *
     * @return ReponseUser
     */
    public function setChoix($choix)
    {
        $this->choix = $choix;

        return $this;
    }

    /**
     * Get choix
     *
     * @return integer
     */
    public function getChoix()
    {
        return $this->choix;
    }

    /**
     * Set question
     *
     * @param \IUT\QCMBundle\Entity\Question $question
     *
     * @return ReponseUser
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
