<?php


namespace App\Service;


use App\Entity\Commande;
use Twig\Environment;

class MailService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function sendConfirmationEmail(Commande $commande)
    {
        $message = (new \Swift_Message('Confirmation de reception de la commande'))
            ->setFrom('test@barbarobox.fr')
            ->setTo($commande->getUsager()->getEmail())
            ->setBody(
                $this->environment->render('email/mailcommande.html.twig',
                    [
                        'commande' => $commande
                    ])
            );
        $this->mailer->send($message);
    }
}