<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class CharactersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("charactersQty", IntegerType::class, [
                'label' => false,
                'attr' => [
                    'min' => 8,
                    'max' => 100
                ]
            ])
            ->add('offset', IntegerType::class, [
                'label' => false,

            ]);
    }
}

