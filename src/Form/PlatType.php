<?php

namespace App\Form;

use App\Entity\CategoriePlat;
use App\Entity\Plat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_plat' , TextType::class,[
                "label" => "Nom du plat",
                "sanitize_html" => true 

            ])            
            ->add('description_plat', TextareaType::class,[
                "label" => "Description du plat",
                "sanitize_html" => true 

            ])            
            ->add('img_plat', FileType::class, [
                'label' => 'Image du plat',
                'mapped' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Seuls les Jpeg/Jpg/Png sont acceptés',
                    ])
                ],
            ])
            ->add('prix_plat')
            ->add('categoriePlats', EntityType::class,[
                'class' => CategoriePlat::class,
                'choice_label' => 'nom_categorie',
                'label' => 'Type de Plat',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true
                
            ])
            ->add('submit', SubmitType::class,[
                'label' => "Créer le Plat"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
