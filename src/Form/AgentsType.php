<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Speciality;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;



class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'label' => 'Prénom',
            ])
            ->add('lastName', null, [
                'label' => 'Nom',
            ])
            ->add('dateOfBirth',BirthdayType::class, [
                'label' => 'Date de naissance',
                'years' => range(1920, 2023),
            ])
            ->add('identificationCode', null, [
                'label' => "Code d'Identification",
            ])
            ->add('nationality', null, [
                'label' =>'Nationalité',
            ])
            ->add('specialties', EntityType::class, [
                'label' => 'Spécialités requises pour la mission',
                'class' => Speciality::class,
                'choice_label' => function ($specialties) {
                    return $specialties->getName() . ' ' ;
                },
                'multiple' => true, // Ou toute autre propriété de l'entité Agent qui doit être affichée
                'expanded' => false, // Fait un select dropdown
            ] )

            ->add('illustration', FileType::class, [
                'label' => 'Illustration',
                'required' => true,
                'mapped' => true,
                'data_class' => null, // Permet de ne pas avoir d'erreur à l'envoi du formulaire
                'attr' => [
                    'accept' => 'image/png, image/jpeg, image/jpg, image/gif',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '10024k', // Limite la taille du fichier à 10024 Ko (10 Mo)
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image au format PNG, JPEG, JPG ou GIF.',
                    ]),
                ],
            ])
            
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
            'label' => 'Formulaire d\'agents', // Titre du formulaire
            'current_illustration' => null, // Ajouter cette option pour pouvoir récupérer l'illustration actuelle
        ]);
    }
}
