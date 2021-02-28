<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactAndServicesController extends AbstractController
{
    /**
     * @Route("/contact-and-services", name="contact_and_services")
     */
    public function index(): Response
    {
        return $this->render('contact_and_services/index.html.twig', [
            'controller_name' => 'ContactAndServicesController',
        ]);
    }
}
