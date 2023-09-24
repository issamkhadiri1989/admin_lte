<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Plan;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterMemberType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'label' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('identity', TextType::class)
            ->add('email', EmailType::class)
            ->add('subscription', EntityType::class, [
                'class' => Plan::class,
                'choice_label' => function (Plan $item) {
                    return \sprintf(
                        '<p><strong>%s</strong><br />A subscription with %.2f $/ per year</p>',
                        $item->getLabel(),
                        $item->getPrice(),
                    );
                },
                'label_html' => true,
                'expanded' => true,
                'label' => false,
                'multiple' => false,
            ]);
    }
}