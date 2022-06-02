<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    public string $Agence = '';

    #[Assert\Length(min: 3, minMessage: 'please your name should have more then 3 letters')]
    public string $Societe;

    #[Assert\Length(min: 3, minMessage: 'please your name should have more then 3 letters')]
    public string $Nom;

    #[Assert\Email]
    public string $Email;

    #[Assert\Length(min: 8, minMessage: 'please your name should have more then 8 letters')]
    public string $Telephone;

    #[Assert\Length(min: 8, minMessage: 'please your name should have more then 8 letters')]
    public string $VotreMessage;

    #[Assert\ReCaptcha]
    public string $Captcha;

}