<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\CategoriePlat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('q', TextType::class,[
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Rechercher'
        ],
        "sanitize_html" => true 

      ])
      ->add ('categories' , EntityType::class,[
        'label' => false,
        'required' => false, 
        'class' => CategoriePlat::class,
        'expanded' => true,
        'multiple' => true
      ])

      
      ;
  }



  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => SearchData::class,
      'method' => 'GET',
      'csrf_protection' => false

    ]);
  }

  public function getBlockPrefix()
  {
    return '';
  }
}