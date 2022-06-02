<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactFormType;
use Monolog\Handler\SwiftMailerHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $dto = new ContactDTO();

        $form = $this->createForm(
            ContactFormType::class,
            $dto
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $text = "<b>Agence</b> : " . $dto->Agence . "\r\n\r\n";
                $text .= "<b>Soci&eacutet&eacute</b> : " . $dto->Societe . "\r\n\r\n";
                $text .= "<b>Nom</b> : " . $dto->Nom . "\r\n\r\n";
                $text .= "<b>Email</b> : " . $dto->Email . "\r\n\r\n";
                $text .= "<b>T&eacutel&eacutephone</b> : " . $dto->Telephone . "\r\n\r\n";
                $text .= "<b>Message</b> : " . $dto->VotreMessage;

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->SMTPAuth   = true;
                    $mail->Host       = $_ENV['MAIL_HOST'];
                    $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
                    $mail->Port       = $_ENV['MAIL_PORT'];
                    $mail->Username   = $_ENV['MAIL_USERNAME'];
                    $mail->Password   = $_ENV['MAIL_PASSWORD'];

                    //Recipients
                    $mail->setFrom('epi_print_1@nec-ingenierie.fr', 'Testing');
                    //$mail->AddAddress("sebastien.colbe@pmb-software.fr");
                    $mail->AddAddress('samuel.steiner@nec-ingenierie.fr');

                    $mail->Subject = 'Contact';
                    $mail->Body    = nl2br($text);
                    $mail->isHTML(true);
                    $mail->send();

                    echo "<script>alert(\"envoyer mail\")</script>";

                    return $this->redirectToRoute("contact");
                } catch (Exception $e) {
                    $mailer = $mail->ErrorInfo;
                }

                return $this->render('contact/index.html.twig', [
                    'controller_name' => 'ContactController',
                    'test' => 5,
                    'mail' => $dto->Captcha,
                    'form' => $form->createView()
                ]);
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'test' => 5,
            'mail' => 0,
            'form' => $form->createView()
        ]);
    }

    #[Route('/mailHog', name: 'sendMailHog')]
    public function mailHog(): Response
    {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->Port = 1025;

        $mail->setFrom('noreply@google.com', 'No-Reply');
        $mail->addAddress('testing@gmail.com', 'Joe User');

        $mail->isHTML(true);

        $mail->Subject = 'test subject 1';
        $mail->Body    = 'test body';

        if(!$mail->send()) {
            $mailer = $mail->ErrorInfo;
        } else {
            $mailer = 'Message has been sent';
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'test' => 5,
            "mail" => $mailer
        ]);
    }

    #[Route('/gmail', name: 'sendGmail')]
    public function gmail(UserPasswordHasherInterface $userPasswordHasher): Response
    {

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $test = password_hash("2525_X_X", PASSWORD_DEFAULT);

        echo "<script>alert(\"$test\")</script>";

        $verify = password_verify("2525_X_X", $test);

        if ($verify) {
            echo "<script>alert(\"correct password\")</script>";
        } else {
            echo "<script>alert(\"incorrect password\")</script>";
        }

        // Print the result depending if they match
        if ($verify) {
            echo 'Password Verified!';
        } else {
            echo 'Incorrect Password!';
        }

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "phpmailertest2022@gmail.com";
        $mail->Password   = "2525_X_X";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->setFrom('noreply@google.com', 'No-Reply');
        $mail->addAddress('phpmailertest2022@gmail.com');

        $mail->isHTML(true);

        $mail->Subject = 'hello world 3 test with hash password';
        $mail->Body    = 'test gmail body';

        if(!$mail->send()) {
            $mailer = $mail->ErrorInfo;
        } else {
            $mailer = 'Message has been sent';
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'test' => 5,
            "mail" => $mailer
        ]);
    }

    #[Route('/outlook', name: 'sendOutlook')]
    public function outlook(): Response
    {
        $text = "<b>Agence</b> : test1\r\n\r\n";
        $text .= "<b>Société</b> : test2\r\n\r\n";
        $text .= "<b>Nom</b> : test3\r\n\r\n";
        $text .= "<b>Email</b> : test4\r\n\r\n";
        $text .= "<b></b> : test5\r\n\r\n";
        $text .= "<b>Message</b> : test6";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'in-v3.mailjet.com';
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Username   = $_ENV['MAIL_USERNAME'];
            $mail->Password   = $_ENV['MAIL_PASSWORD'];

            //Recipients
            $mail->setFrom('epi_print_1@nec-ingenierie.fr', 'Testing');
            //$mail->AddAddress("sebastien.colbe@pmb-software.fr");
            $mail->AddAddress('samuel.steiner@nec-ingenierie.fr');

            $mail->Subject = 'Contact';
            $mail->Body    = nl2br($text);
            $mail->isHTML(true);
            $mail->send();

            $mailer = 'Message has been sent';
        } catch (Exception $e) {
            $mailer = $mail->ErrorInfo;
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'test' => 5,
            "mail" => $mailer
        ]);
    }
}
