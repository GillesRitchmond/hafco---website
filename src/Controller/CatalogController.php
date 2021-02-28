<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{

    
    /**
     * @var ProductRepository
     */

    private $repository;

    /**
     * @var EntityManagerInterface
     */

    private $em;



    public function __construct (ProductRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->repository = $em;
    }



    /**
     * @Route("/catalog", name="catalog")
     * @return Response
     */
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findLatest();
       

        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'products' => $products,
        ]);
        
    }
}
