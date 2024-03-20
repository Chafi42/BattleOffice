<?php

namespace App\Form;

use App\Entity\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                    'allow_extra_fields' => true,
            'data_class' => File::class, 
        ]);
    }
}
