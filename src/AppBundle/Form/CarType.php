<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 11.03.18
 * Time: 22:27
 */

namespace AppBundle\Form;


use AppBundle\Entity\Car;
use AppBundle\Entity\Photo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
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
             ->add('brand', TextType::class, ['label' => 'Marka', 'required' => false])
             ->add('model', TextType::class, ['label' => 'Model', 'required' => false])
             ->add('version', TextType::class, ['label' => 'Wersja', 'required' => false])
             ->add('engine', TextType::class, ['label' => 'Silnik', 'required' => false])
             ->add('productionYear', NumberType::class, ['label' => 'Rok produkcji', 'required' => false])
             ->add('mileage', NumberType::class, ['label' => 'Przebieg', 'required' => false])
             ->add('seats', NumberType::class, ['label' => 'Ilość siedzeń', 'required' => false])
             ->add('gearshift', TextType::class, ['label' => 'Skrzynia biegów', 'required' => false])
             ->add('airConditioning', TextType::class, ['label' => 'Klimatyzacja', 'required' => false])
             ->add('vin', TextType::class, ['label' => 'Numer VIN', 'required' => false])
             ->add('registrationNumber', TextType::class, ['label' => 'Numer rejestracyjny', 'required' => false])
             ->add('fuel', TextType::class, ['label' => 'Rodzaj paliwa', 'required' => false])
             ->add('category', ChoiceType::class, [
                 'label' => 'Klasa',
                 'choices'  => [
                     'Auta małe' => 'small',
                     'Klasa średnia' => 'middle',
                     'Klasa wyższa' => 'top',
                     'SUV' => 'suv'
                     ]]
             )
             ->add('photos', CollectionType::class, [
                 'label' => 'Zdjęcia',
                 'entry_type' => PhotoType::class,
                 'allow_add' => true,
                 'allow_delete' => true
             ])
             ->add('create', SubmitType::class, ['label' => 'Dodaj samochód']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class
        ]);
    }
}
