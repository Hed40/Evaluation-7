<?php

namespace App\Form;

use App\Entity\Missions;
use App\Validator\Constraints\UniqueNationality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Targets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('title', null, [
                'label' => 'Titre de la mission'
            ])
            ->add('description', null, [
                'label' => 'Description de la mission'
            ])
            ->add('codeName', null, [
                'label' => 'Nom de code de la mission'
            ])
            ->add('country', null, [
                'label' => 'Pays de la mission'
            ])
            ->add('startDate', null, [
                'label' => 'Date de début'
            ])
            ->add('endDate', null, [
                'label' => 'Date de fin'
            ])
            ->add('agents', EntityType::class, [
                'class' => Agents::class,
                'choice_label' => function ($agent) {
                    return $agent->getFirstName() . ' ' . $agent->getLastName();
                },

                'multiple' => true, // Ou toute autre propriété de l'entité Agent qui doit être affichée
                'expanded' => true, // Fait un select dropdown
            ])
            
            ->add('contacts',EntityType::class, [
                'class' => Contacts::class,
                'choice_label' => function ($contact) {
                    return $contact->getFirstName() . ' ' . $contact->getLastName();
                },
                'multiple' => true, // Ou toute autre propriété de l'entité Agent qui doit être affichée
                'expanded' => true, // Fait un select dropdown
            ])

            ->add('targets', EntityType::class, [
                'label' => 'Cibles de la mission',
                'class' => Targets::class,
                'choice_label' => function ($target) {
                    return $target->getFirstName() . ' ' . $target->getLastName();
                },
                'multiple' => true, // Ou toute autre propriété de l'entité Agent qui doit être affichée
                'expanded' => true, // Fait un select dropdown
            ] )

            ->add('statut', ChoiceType::class, [
                'label' => 'Statut de la mission',
                'choices' => [
                    'En cours' => 'En cours',
                    'En attente' => 'En attente', 
                    'Terminée' => 'Terminée', 
                    'Annulée' => 'Annulée', 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
