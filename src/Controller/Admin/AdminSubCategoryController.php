<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\SubCategoryRepository;
use App\Entity\SubCategory;
use App\Form\SubCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSubCategoryController extends AbstractController
{
    /**
     * @var SubCategoryRepository
     */
    private $repository;

    public function __construct(SubCategoryRepository $repository, EntityManagerInterface $em)
    {
        //$this->repository->$repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin-subcategory-list", name="admin-subcategory")
     */
    public function index(SubCategoryRepository $repository, PaginatorInterface $paginatorInterface): Response
    {
        $subcategories = $repository->findAll();
        return $this->render('admin_subcategory/index.html.twig', [
            'controller_name' => 'AdminSubCategoryController',
            'subcategories' => $subcategories
        ]);
    }

    /**
     * @Route("/admin/new-subcategory", name="admin.subcategory.new")
     * @param SubCategory $subcategory
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $subcategory = new SubCategory();
        $form = $this->createForm(SubCategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($subcategory);
            $this->em->flush();
            $this->addFlash('success', 'Votre enregistrement a été faite avec succès');
            return $this->redirectToRoute('admin-subcategory');
        }

        return $this->render('admin_subcategory/new_subcategory.html.twig', [
            'controller_name' => 'AdminSubCategoryController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-subcategory/{id}", name="admin.subcategory.edit", methods="GET|POST")
     * @param SubCategory $subcategory
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(SubCategory $subcategory, Request $request)
    {
        $form = $this->createForm(SubCategoryType::class, $subcategory);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Votre modification a été faite avec succès');
            return $this->redirectToRoute('admin-subcategory');
        }

        return $this->render('admin_subcategory/edit_subcategory.html.twig', [
            'controller_name' => 'AdminSubCategoryController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/edit-subcategory/{id}", name="admin.subcategory.delete", methods="DELETE")
     * @param SubCategory $subcategory
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(SubCategory $subcategory, Request $request)
    {
        if($this->isCsrfTokenValid('delete'. $subcategory->getId(), $request->get('_token')))
        {
            $this->em->remove($subcategory);
            $this->em->flush();
            $this->addFlash('success', 'Votre suppression a été faite avec succès');
            return $this->redirectToRoute('admin-subcategory');
        }
        return $this->redirectToRoute('admin-subcategory');
    }

}
