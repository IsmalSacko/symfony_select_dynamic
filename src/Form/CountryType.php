<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', EntityType::class,[

                'class'=> Country::class,
                'choice_label' => 'name',
                'label' => 'Your contry\'s name',
                'query_builder' => function (CountryRepository $country){
                 return $country->createQueryBuilder('country')->orderBy('country.name', 'ASC');
                },
                'placeholder' => 'Please choose your country 🏴'
            ])
            ->add('cities', EntityType::class,[
                'class'=> City::class,
                'mapped' => false,
                'required' => false,
                "label" => 'Your city\'s name',
                'placeholder' => 'Please choose your city\'s name 🌆',
                'query_builder' => function($country){
                    return $country->createQueryBuilder('city')->orderBy('city.id','ASC');
                }
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            'data_class' => Country::class,
        ]);
    }
}
