<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('complementary', TextType::class, [
                'required' => false,
            ])
            ->add('city')
            ->add('postalCode')
            ->add('country')
            ->add('phone')
            // ->add('mail')

            ->add('mail', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'votre mail n\'est pas valide',
                'options' => ['attr' => ['class' => 'email-field']],
                'required' => true,
                'first_options' => ['label' => 'Email'],
                'second_options' => ['label' => 'Confirmation email'],
            ])
            // ->add('status')
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
            'allow_extra_fields' => true,
        ]);
    }
}
