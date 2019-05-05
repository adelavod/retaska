<?php

namespace App\Form;

use App\Entity\Objednavka;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjednavkaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('telephone')
            ->add('name')
            ->add('surname')
            ->add('street')
            ->add('city')
            ->add('psc')
            ->add('poznamka')
            ->add('product')
            ->add('country')
            ->add('payment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objednavka::class,
        ]);
    }
}
