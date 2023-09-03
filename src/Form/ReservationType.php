<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\HoraireReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_reservation', DateType::class,[
                "label" => "Date de réservation", 
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['class' => 'js-datepicker'],
                "required" => true


            ])
            ->add('couverts_reservation' , NumberType::class,[
                'html5' => true,
                "label" => "Nombre de couverts",
                "required" => true
            ])
            ->add('allergie_reservation', TextType::class,[
                "label" => "Vos allergies",
                "required" => false,
                "sanitize_html" => true 


            ])
        
            ->add('commentaire_reservation' , TextType::class,[
                "label" => "Commentaires (enfants , emplacement...)",
                "required" => false,
                "sanitize_html" => true 

            ])
            ->add('horaireReservations', EntityType::class,[
                'class' => HoraireReservation::class,
                "label" => "Heure de réservation",
                "choice_label" => 'heure_reservation',
                'by_reference' => false,
                'multiple' => true, 
                'mapped' => true,
                'required' => true
            ])
            ->add('submit', SubmitType::class,[
                'label' => "Reserver"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
