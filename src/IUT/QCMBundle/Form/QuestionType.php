<?php
/**
 * Created by PhpStorm.
 * User: Ilias
 * Date: 15/01/2016
 * Time: 14:29
 */

namespace IUT\QCMBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, array(
                'label' => 'Intitulé',
                'attr' => array('class' => 'validate')
            ))
            ->add('bareme', RangeType::class, array(
                'label' => 'Barème',
                'attr' => array(
                    'id' => 'test5',
                    'min' => 0.5,
                    'max' => 20,
                    'step' => 0.5
                    )
            ));
    }

}