<?php

namespace App\Controller;

use App\DTO\RejoignezNousDTO;
use App\Form\RejoignezNousFormType;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PHPMailer\PHPMailer\SMTP;

class RejoignezController extends AbstractController
{
    #[Route('/rejoignez', name: 'app_rejoignez')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $dto = new RejoignezNousDTO();

        $form = $this->createForm(
            RejoignezNousFormType::class,
            $dto
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $text = "<b>" . htmlentities("Prénom") . ": </b> " . htmlentities($dto->Prenom) . "\r\n\r\n";
            $text .= "<b>Nom</b> : " . htmlentities($dto->Nom) . "\r\n\r\n";
            $text .= "<b>Email</b> : " . htmlentities($dto->Email) . "\r\n\r\n";
            $text .= "<b>T&eacutel&eacutephone</b> : " . htmlentities($dto->Telephone) . "\r\n\r\n";
            $text .= "<b>Message</b> : " . htmlentities($dto->VotreMessage) . "\r\n\r\n";

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
                $mail->setFrom('samuel.steiner@nec-ingenierie.fr', 'Testing');
                //$mail->AddAddress("sebastien.colbe@pmb-software.fr");
                $mail->AddAddress('samuel.steiner@nec-ingenierie.fr');

                $file = $form['File']->getData();

                $mail->addAttachment($dto->File, utf8_decode($file->getClientOriginalName()));

                $mail->Subject = utf8_decode($dto->Sujet);
                $mail->Body    = nl2br($text);
                $mail->isHTML(true);
                $mail->send();

                echo "<script>alert(\"mail sent\")</script>";

                $mailer = 'Message has been sent';

                return $this->redirectToRoute("app_rejoignez");
            } catch (Exception $e) {
                $mailer = $mail->ErrorInfo;
            }

            return $this->render('rejoignez/index.html.twig', [
                'controller_name' => 'RejoignezController',
                'form' => $form->createView(),
                'Nom' => $file->getClientOriginalName(),
                'Mail' => $dto->Email,
                'File' => $dto->File,
                'test' => 6,
            ]);
        }

        return $this->render('rejoignez/index.html.twig', [
            'controller_name' => 'RejoignezController',
            'form' => $form->createView(),
            'Nom' => null,
            'Mail' => null,
            'File' => null,
            'test' => 6,
        ]);
    }

    #[Route('/rejoignez/CV', name: 'get_CV')]
    public function getCV(): Response
    {
        $finder = new Finder();

        $finder->files()->in(__DIR__);

        return $this->render('rejoignez/index.html.twig', [
            'controller_name' => 'RejoignezController',
        ]);
    }
}
