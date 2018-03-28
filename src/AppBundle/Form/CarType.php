<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 11.03.18
 * Time: 22:27
 */

namespace AppBundle\Form;


use AppBundle\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->add('brand', TextType::class, ['label' => 'Marka'])
             ->add('model', TextType::class, ['label' => 'Model'])
             ->add('version', TextType::class, ['label' => 'Wersja'])
             ->add('engine', TextType::class, ['label' => 'Silnik'])
             ->add('productionYear', NumberType::class, ['label' => 'Rok produkcji'])
             ->add('mileage', NumberType::class, ['label' => 'Przebieg'])
             ->add('seats', NumberType::class, ['label' => 'Ilość siedzeń'])
             ->add('gearshift', TextType::class, ['label' => 'Skrzynia biegów'])
             ->add('airConditioning', TextType::class, ['label' => 'Klimatyzacja'])
             ->add('vin', TextType::class, ['label' => 'Numer VIN'])
             ->add('registrationNumber', TextType::class, ['label' => 'Numer rejestracyjny'])
             ->add('fuel', TextType::class, ['label' => 'Rodzaj paliwa'])
             ->add('photos', FileType::class, ['label' => 'Zdjęcia', 'multiple' => true, 'data_class' => null])
             ->add('create', SubmitType::class, ['label' => 'Dodaj samochód']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class
        ]);
    }
}