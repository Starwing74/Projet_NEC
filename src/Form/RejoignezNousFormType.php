<?php

namespace App\Form;

use App\DTO\RejoignezNousDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;


class RejoignezNousFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Prenom', TextType::class, ['label' => 'Prenom :', 'attr' => ['style' => 'width: 100%', 'placeholder' => 'Prénom*']])
            ->add('Nom', TextType::class, ['label' => 'Name :', 'attr' => ['style' => 'width: 100%', 'placeholder' => 'Nom*']])
            ->add('Email', EmailType::class, ['label' => 'Mail :', 'attr' => ['style' => 'width: 100%', 'placeholder' => 'Email*']])
            ->add('Telephone', TextType::class, ['label' => 'Name :', 'attr' => ['style' => 'width: 100%', 'placeholder' => 'Téléphone*']])
            ->add('Sujet', TextType::class, ['label' => 'Name :', 'attr' => ['style' => 'width: 100%', 'placeholder' => 'Sujet*']])
            ->add('File', FileType::class, ['label' => null, 'attr' => ['style' => 'width: 100%', 'class' => 'd-none', 'onchange' =>"this.parentNode.querySelector('.input-group input').value = (this.files.length > 0 ? this.files[0].name : '');"]])
            ->add('VotreMessage', TextareaType::class, ['label' => 'Name :', 'attr' => ['style' => 'width: 100%; min-height: calc(1.5em + .75rem + 2px);', 'placeholder' => 'Votre message*']])
            ->add('Captcha', ReCaptchaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RejoignezNousDTO::class,
        ]);
    }
}