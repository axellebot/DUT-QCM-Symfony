<?php
/**
 * Created by PhpStorm.
 * User: Ilias
 * Date: 14/01/2016
 * Time: 18:09
 */

namespace IUT\QCMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Adresse e-mail',
                'attr' => array('class' => 'validate')
            ))
            ->add('username', TextType::class, array(
                'label' => 'Nom d\'utilisateur',
                'attr' => array('class' => 'validate')
            ))
            ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Repéter le mot de passe'),
                    'attr' => array('class' => 'validate'))
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IUT\QCMBundle\Entity\User'
        ));
    }
}