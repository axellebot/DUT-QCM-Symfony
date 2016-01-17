<?php
/**
 * Created by PhpStorm.
 * User: Ilias
 * Date: 15/01/2016
 * Time: 14:29
 */

namespace IUT\QCMBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ))
            ->add('reponses', CollectionType::class, array(
                'entry_type'   => TextType::class,
                'allow_add' => true,
                'entry_options'  => array(
                    'required'  => true,
                    'attr'      => array(
                        'class' => 'validate',
                        'placeholder' => 'Réponse'
                    )
                ),
            ));
    }

}