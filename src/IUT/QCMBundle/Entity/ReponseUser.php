<?php

namespace IUT\QCMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
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
     * @ORM\Column(name="choix", type="boolean")
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


}
