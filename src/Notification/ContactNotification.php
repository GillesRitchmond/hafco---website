<?php
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Twig\Environment;

Class ContactNotification{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;
    
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact){
        $message = ( new \Swift_Message('Produits :' . $contact->getProduct()->getProductName()))
            ->setFrom('noreply@127.0.0.1:8000')
            ->setTo('contact@127.0.0.1:8080')
            // ->setTo('gritchmond@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig',[
                'contact' => $contact
            ]),'text/html');
            // $this->mailer->send($message);
            try {
                $this->mailer->send($message);     
            } catch (TransportExceptionInterface $e) {
                // some error prevented the email sending; display an
                // error message or try to resend the message
            }
    }
}