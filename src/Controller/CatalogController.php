<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\ProductByCategory;
use App\Entity\ProductSearch;
use App\Form\ContactType;
use App\Form\ProductByCategoryForm;
use App\Form\ProductSearchType;
use App\Notification\ContactNotification;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @var CategoryRepository
     */

    private $categoryrepository;

    /**
     * @var EntityManagerInterface
     */

    private $em;

    

    public function __construct (ProductRepository $repository, CategoryRepository $categoryRepository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->repository = $em;
    }



    /**
     * @Route("/catalog", name="catalog")
     * @return Response
     */
    public function index(PaginatorInterface $paginatorInterface, Request $request, ProductRepository $repository, CategoryRepository $categoryRepository): Response
    {
        // $product = $repository->findAllProducts();

        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);
        
        $products = $paginatorInterface->paginate(
            $repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), 
            12
        );

        // $productByCategory =$paginatorInterface->paginate(
        //     $repository->findAllVisibleQuery($search),
        //     $request->query->getInt('page', 1),
        //     12
        // );

        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('catalog/_index.html.twig',['products'=>$products])
            ]);
        }

        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'products' => $products,
            // 'productByCategory' => $productByCategory,
            'form' => $form->createView()
        ]);
        
    }


    /**
     * @Route("/catalogue/{slug}-{id}", name="product.show", requirements={"slug": "[A-Za-z0-9\-]*"})
     * @return Response
     * @param Product $product
     */
    public function show(Product $products, string $slug, int $id, Request $request, ContactNotification $notification): Response
    {
        
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


        $contact = new Contact();
        $contact->setProduct($product);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {   
            $notification->notify($contact);
            $this->addFlash('success','Votre message a été envoyer avec succès');
            return $this->redirectToRoute('product.show',[
                'id' => $products->getId(),
                'slug' => $products->getSlug(),
            ]);
        }

        
        // return new Response('Check out this great product: '.$product->getName());


        //$product = $this->repository->find($id);
        return $this->render('catalog/show.html.twig', [
            'controller_name' => 'CatalogController',
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
