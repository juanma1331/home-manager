<?php

namespace App\Form;

use App\Entity\Inventory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InventoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'This field is required idiot.']),
                    new Length([
                        'min' => 3,
                        'max' => 10,
                        'minMessage' => 'This is too short',
                        'maxMessage' => 'This is too long'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inventory::class,
        ]);
    }
}
