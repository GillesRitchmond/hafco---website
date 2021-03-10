<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\ProductSearchType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginatorInterface, Request $request, ProductRepository $repository): Response
    {
        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);


        $products = $paginatorInterface->paginate(
            $repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), 
            12
        );
       

        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'products' => $products,
            'form' =>$form->createView()
        ]);
        
    }

    /**
     * @Route("/catalogue/{slug}-{id}", name="product.show", requirements={"slug": "[A-Za-z0-9\-]*"})
     * @return Response
     */
    public function show(Product $products, string $slug, int $id): Response
    {
        // if ($products->getSlug()) !== $slug)
        // {
        //     return $this->redirectToRoute('product.show',[
        //         'id' => $products->getId(),
        //         'slug' => $products->getSlug()
        //     ], 301);
        // }

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$products) {

            return $this->redirectToRoute('product.show',[
                'id' => $products->getId(),
                'slug' => $products->getSlug()
            ], 301);

            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        // return new Response('Check out this great product: '.$product->getName());


        //$product = $this->repository->find($id);
        return $this->render('catalog/show.html.twig', [
            'controller_name' => 'CatalogController',
            'product' => $product
        ]);
    }
}
