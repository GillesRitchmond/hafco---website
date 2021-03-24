<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

     /**
     * @var ProductRepository
     */

    private $repository;


    /**
     * @Route("/home", name="home")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findLatest();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'products' => $products
        ]);
    }
}
