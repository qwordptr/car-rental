<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 15.10.17
 * Time: 13:34
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Nazwa użytkownika'])
            ->add('password', PasswordType::class, ['label' => 'Hasło'])
            ->add('login', SubmitType::class, ['label' => 'Zaloguj']);
    }
//
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => User::class,
//        ));
//    }
}