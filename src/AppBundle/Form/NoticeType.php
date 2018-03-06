<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 26.10.17
 * Time: 22:03
 */

namespace AppBundle\Form;


use AppBundle\Entity\Notice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Tytuł ogłoszenia'])
            ->add('price', NumberType::class, ['label' => 'Cena',
                'rounding_mode' => 1])
            ->add('description', TextareaType::class, ['label' => 'Opis ogłoszenia'])
            ->add('category', EntityType::class, ['class' => 'AppBundle:Category', 'label' => 'Kategoria'])
            ->add('type', ChoiceType::class, ['label' => 'Typ ogłoszenia', 'choices' => [
                'Sprzedam' => 'sprzedam',
                'Kupię' => 'kupie',
                'Zamienię' => 'zamienie'
            ]])
            ->add('content', TextareaType::class, ['label' => 'Treść ogłoszenia'])
            ->add('create', SubmitType::class, ['label' => 'Dodaj ogłoszenie'])
            ->add('attachments', FileType::class, [
                'label' => 'Zdjęcia',
                'multiple' => true,
                'data_class' => null,
                'required' => false,
            ])
        ;//
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Notice::class,
        ));
    }
}