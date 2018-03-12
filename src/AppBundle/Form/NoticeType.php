<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 26.10.17
 * Time: 22:03
 */

namespace AppBundle\Form;


use AppBundle\Entity\Car;
use AppBundle\Entity\Notice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoticeType extends AbstractType
{
    private $cars;

    public function __construct($cars = null)
    {
        $this->cars = $cars;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->cars = $options['cars'];

        $builder
            ->add('price', NumberType::class, ['label' => 'Cena',
                'rounding_mode' => 1])
            ->add('car', EntityType::class, [ 'label' => 'Pojazd',
                'class' => Car::class,
                'choices'=> $this->cars
            ])
            ->add('expiredAt', DateTimeType::class, ['label' => 'Ważne do...',
                'html5' => false,
                'widget' => 'single_text'])
            ->add('create', SubmitType::class, ['label' => 'Dodaj ogłoszenie'])
        ;//
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Notice::class,
            'cars' => null
        ));
    }
}