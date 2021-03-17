<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\ProductSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', TextType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ex: meuble de bureau'
                ]
            ])
            // ->add('categoriesName', EntityType::class, [
            //     'required' => false,
            //     'label' => false,
            //     'placeholder' => 'Catégories',
            //     'class' => Category::class,
            //     'choice_label' => 'categoryName',
            //     'multiple' => false
            // ])

            // ->add('categories', EntityType::class, [
            //     'class' => Category::class,
            //     'choice_label' => function ($category) {
            //         return $category->getCategoryName();
            //     }
            // ])

            // ->add('submit', SubmitType::class, [
            //     // 'label'=> 'Rechercher'  
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductSearch::class,
            'method' => 'get',
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
