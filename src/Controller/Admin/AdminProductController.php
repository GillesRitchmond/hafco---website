<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository, EntityManagerInterface $em)
    {
        //$this->repository->$repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin-product")
     */
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        return $this->render('admin_product/index.html.twig', [
            'controller_name' => 'AdminProductController',
            'products' => $products
        ]);
    }

    /**
     * @Route("/admin/new-product", name="admin.product.new")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($product);
            $this->em->flush();
            $this->addFlash('success', 'Votre enregistrement a été faite avec succès');
            return $this->redirectToRoute('admin-product');
        }

        return $this->render('admin_product/new.html.twig', [
            'controller_name' => 'AdminProductController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-product/{id}", name="admin.product.edit", methods="GET|POST")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Votre modification a été faite avec succès');
            return $this->redirectToRoute('admin-product');
        }

        return $this->render('admin_product/edit.html.twig', [
            'controller_name' => 'AdminProductController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-product/{id}", name="admin.product.delete", methods="DELETE")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Product $product, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $product->getId(), $request->get('_token')))
        {
            $this->em->remove($product);
            $this->em->flush();
            $this->addFlash('success', 'Votre suppression a été faite avec succès');
            return $this->redirectToRoute('admin-product');
        }
        return $this->redirectToRoute('admin-product');
    }

}
