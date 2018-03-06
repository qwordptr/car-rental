<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 15.10.17
 * Time: 09:35
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Twój email',
            ])
            ->add('username', TextType::class, ['label' => 'Nazwa użytkownika'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Hasło'],
                'second_options' => ['label' => 'Powtórz hasło'],
            ])
            ->add('first_name', TextType::class, ['label' => 'Imię'])
            ->add('last_name', TextType::class, ['label' => 'Nazwisko'])
            ->add('gender', ChoiceType::class, [
                'label' => 'Płeć',
                'choices' => [
                    'Mężczyzna' => 'male',
                    'Kobieta'   => 'female'
                ]
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Data urodzenia',
                'html5' => true,
            ])
            ->add('register', SubmitType::class, ['label' => 'Zarejestruj']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}