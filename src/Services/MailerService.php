<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService{
    

    public function __construct( private MailerInterface $mailer ){}
    public function sendEmail(
        $to ='makrembhmed@gmail.com',
        $content='<p>See Twig integration for better HTML integration!</p>',
        $subject='Time for Symfony Mailer!'
    ): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text('Sending emails is fun again!')
            ->html($content);

        $this->mailer->send($email);

        // ...
    }

}