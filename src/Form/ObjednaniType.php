<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Objednani;
use App\Entity\Payment;
use App\Entity\Shipping;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjednaniType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('telephone')
            ->add('street')
            ->add('city')
            ->add('zipcode')
            ->add('message')


            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name'
            ])
            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'name',
                'choice_attr' => function (Payment $payment) {
                    return ['data-payment' => $payment->getPrice()];
                }])

            ->add('shipping', EntityType::class, [
                'class' => Shipping::class,
                'choice_label' => 'name',
                'choice_attr' => function (Shipping $shipping) {
                    return ['data-shipping' => $shipping->getPrice()];
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objednani::class,
        ]);
    }
}
