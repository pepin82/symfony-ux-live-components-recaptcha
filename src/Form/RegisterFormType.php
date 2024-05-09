<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min:3, max:255)
                ]
            ])
            ->add('surname', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min:3, max:255)
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email()
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'always_empty' => false
                ],
                'second_options' => [
                    'always_empty' => false
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min:3, max:20)
                ]
            ]);
    }
}