<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactAndServicesController extends AbstractController
{
    /**
     * @Route("/contact-and-services", name="contact_and_services")
     */
    public function index(Request $request, ContactNotification $notification): Response
    {
        // $contact = new Contact();
        // $form = $this->createForm(ContactType::class, $contact);
        // $form->handleRequest($request);

        // if($form->isSubmitted() && $form->isValid())
        // {   
        //     $notification->notify($contact);
        //     $this->addFlash('success','Votre message a été envoyer avec succès');
            
        //     return $this->render('contact_and_services/index.html.twig', [
        //         'controller_name' => 'ContactAndServicesController',
        //     ]);
        // }

        return $this->render('contact_and_services/index.html.twig', [
            'controller_name' => 'ContactAndServicesController',
        ]);
    }
}
