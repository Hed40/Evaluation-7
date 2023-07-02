<?php

namespace App\Form;

use App\Entity\Agents;
use Symfony\Component\Form\AbstractType;
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
            ->add('specialties', null, [
                'label' => 'Spécialités',
            ])
            ->add('illustration', FileType::class, [
                'label' => 'Illustration',
                'required' => true,
                'mapped' => true,
                'data_class' => null, // Ajouter cette option pour pouvoir récupérer l'illustration actuelle
                'attr' => [
                    'accept' => 'image/png, image/jpeg, image/jpg, image/gif',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k', // Limite la taille du fichier à 1024 Ko (1 Mo)
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
            'current_illustration' => null, // Ajouter cette option pour pouvoir récupérer l'illustration actuelle
        ]);
    }
}
