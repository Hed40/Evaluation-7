<?php

namespace App\Form;

use App\Entity\Targets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TargetsType extends AbstractType
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
            ->add('codeName', null, [
                'label' => "Nom de code",
            ])
            ->add('nationality', null, [
                'label' =>'Nationalité',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Targets::class,
        ]);
    }
}
