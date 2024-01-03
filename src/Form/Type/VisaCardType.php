<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\VisaCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisaCardType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', VisaCard::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cardNumber', TextType::class)
            ->add('month', ChoiceType::class, [
                'choices' => [
                    'Janvier' => 'jan',
                    'Fevrier' => 'fev',
                    'Mars' => 'mar',
                    'Avril' => 'avr',
                    'Mai' => 'mai',
                    'Juin' => 'jun',
                    'Juillet' => 'jui',
                    'Aout' => 'aou',
                    'Septembre' => 'sep',
                    'Octobre' => 'oct',
                    'Novembre' => 'nov',
                    'Decembre' => 'dec',
                ],
            ])
            ->add('year', ChoiceType::class, [
                'choices' => $this->createYears(),
            ])
            ->add('cvv', TextType::class);
    }

    public function createYears(): array{
        $initialYear = \date('Y');
        $years = \range($initialYear, $initialYear + 10);

        return  array_combine($years,  $years); // 2024 => 2024 , 2025 => 2025 ...
    }
}
