<?php

namespace IUT\QCMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, array(
                'attr' => array(
                    'class' => 'validate',
                    'placeholder' => 'Réponse'
                ),
            ))
            ->add('correcte', CheckboxType::class, array(
                'label' => ' ',
                'required' => false,
                'attr' => array(
                    'class' => 'validate'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IUT\QCMBundle\Entity\Reponse'
        ));
    }
}
