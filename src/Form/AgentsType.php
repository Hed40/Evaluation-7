<?php

namespace App\Form;

use App\Entity\Agents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('dateOfBirth', null, [
                'label' => 'Date de naissance',
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
            //->add('imageFile', FileType::class, [
                //'label' => 'Image',
            //])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
