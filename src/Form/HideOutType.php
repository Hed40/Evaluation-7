<?php

namespace App\Form;

use App\Entity\HideOut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HideOutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', null, [
                'label' => 'Code',
            ])
            ->add('country', null, [
                'label' => 'Pays',
            ])
            ->add('type', null, [
                'label' => 'Type de planque',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HideOut::class,
        ]);
    }
}
