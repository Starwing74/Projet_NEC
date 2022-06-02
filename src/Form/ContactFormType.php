<?php

namespace App\Form;

use App\DTO\ContactDTO;
use App\DTO\RejoignezNousDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Agence', ChoiceType::class, [
                'choices' => [
                    'Choisir votre angence de référence' => '',
                    'Épinal' => '&Eacutepinal',
                    'Lyon' => 'Lyon',
                    'Paris' => 'Paris',
                ],'label' => 'Agence*',
                'attr' => ['style' => 'width: 100%']
            ])
            ->add('Societe', TextType::class, ['label' => 'Societe :','attr' => ['style' => 'width: 100%', 'placeholder' => 'Société']])
            ->add('Nom', TextType::class, ['label' => 'Nom :','attr' => ['style' => 'width: 100%', 'placeholder' => 'Nom*']])
            ->add('Email', EmailType::class, ['label' => 'Email :','attr' => ['style' => 'width: 100%', 'placeholder' => 'Email*']])
            ->add('Telephone', TextType::class, ['label' => 'Telephone :','attr' => ['style' => 'width: 100%', 'placeholder' => 'Téléphone*']])
            ->add('VotreMessage', TextareaType::class, ['label' => 'VotreMessage :','attr' => ['style' => 'width: 100%; min-height: calc(1.5em + .75rem + 2px);', 'placeholder' => 'Votre message*', 'required' => true]])
            ->add('Captcha', ReCaptchaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}