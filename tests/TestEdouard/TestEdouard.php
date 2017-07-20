<?php

use Silex\Provider\SwiftmailerServiceProvider;

class TestEdouard
{
    public function sendMail()
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
        ->setUsername('doud')
        ->setPassword('doud')
       ;

       // Create the Mailer using your created Transport
       $mailer = new Swift_Mailer($transport);

       // Create a message
       $message = (new Swift_Message('Objet du mail de doud'))
         ->setFrom(['doud75@gmail.com' => 'Doud75'])
         ->setTo(['edouard.anthony@gmail.com', 'other@domain.org' => 'Mr ANTHONY'])
         ->setBody('Contenu de mon premier mail via Swiftmailer')
         ;

       // Send the message
       $result = $mailer->send($message);
    }
}
