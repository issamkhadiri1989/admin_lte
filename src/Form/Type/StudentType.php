<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('fullName', Type\TextType::class, [
            'required' => false,
            'attr' => [
                'class' => 'class1 class2 class3'
            ],
            'label' => 'Nom complet'
        ])
            ->add('email', Type\EmailType::class, [
                'label' => 'Email'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}