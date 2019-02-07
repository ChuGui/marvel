<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CharactersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("charactersQty", IntegerType::class, [
                'label' => false,
                'constraints' => new Length([
                    'min' => 8,
                    'minMessage' => "Voyons... il faudrait que je puisse t'afficher au minimum 1 personnage :)",
                    'max' => 100,
                    "maxMessage" => "Hop Hop Hop ! On a dit pas plus de 100 persos à la fois !"
                ]),
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

