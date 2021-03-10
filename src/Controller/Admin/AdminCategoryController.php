<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository, EntityManagerInterface $em)
    {
        //$this->repository->$repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin-category-list", name="admin-category")
     */
    public function index(CategoryRepository $repository): Response
    {
        $categories = $repository->findAll();
        return $this->render('admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/new-category", name="admin.category.new")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success', 'Votre enregistrement a été faite avec succès');
            return $this->redirectToRoute('admin-category');
        }

        return $this->render('admin_category/new_category.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-category/{id}", name="admin.category.edit", methods="GET|POST")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Votre modification a été faite avec succès');
            return $this->redirectToRoute('admin-category');
        }

        return $this->render('admin_category/edit_category.html.twig', [
            'controller_name' => 'AdminCategoryController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-category/{id}", name="admin.category.delete", methods="DELETE")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Category $category, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $category->getId(), $request->get('_token')))
        {
            $this->em->remove($category);
            $this->em->flush();
            $this->addFlash('success', 'Votre suppression a été faite avec succès');
            return $this->redirectToRoute('admin-category');
        }
        return $this->redirectToRoute('admin-category');
    }

}
