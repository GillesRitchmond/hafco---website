<?php
namespace App\Notification;

use App\Entity\Contact;
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
            ->setFrom('noreply@hafcomeubles.com')
            // ->setTo('contact@hafcomeubles.com')
            ->setTo('gritchmond@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig',[
                'contact' => $contact
            ]),'text/html');
            $this->mailer->send($message);
    }
}