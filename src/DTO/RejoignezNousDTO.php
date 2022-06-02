<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class RejoignezNousDTO
{
    #[Assert\Length(min: 3, minMessage: 'please your first name should have more then 3 letters')]
    public string $Prenom;

    #[Assert\Length(min: 3, minMessage: 'please your name should have more then 3 letters')]
    public string $Nom;

    #[Assert\Email]
    public ?string $Email = null;

    #[Assert\Length(min: 8, minMessage: 'please your name should have more then 8 letters')]
    public string $Telephone;

    #[Assert\Length(min: 3, minMessage: 'please your name should have more then 3 letters')]
    public string $Sujet;

    #[Assert\File(
        maxSize: '1M',
        maxSizeMessage: 'Please upload a smaller file' ,
        mimeTypes: ['application/pdf', 'application/x-pdf'],
        mimeTypesMessage: 'Please upload a valid PDF',
    )]
    public ?string $File = null;

    #[Assert\Length(min: 8, minMessage: 'please your name should have more then 8 letters')]
    public string $VotreMessage;

    #[Assert\ReCaptcha]
    public string $Captcha;

}