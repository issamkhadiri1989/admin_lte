<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $builder
            ->add('label', TextType::class)
            ->add('description',  TextareaType::class)
            ->add('price', NumberType::class)
            /*->add('send', SubmitType::class, [
                'attr' => [
                    'class' => 'my-css-class',
                ],
            ])*/;
    }
}