<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // private $category;

        $builder
            ->add('productName', null, [
                'label' => 'Nom du produit'
            ], TextType::class)
            ->add('productDescription', null, [
                'label' => 'Description du produit'
            ], TextareaType::class)
            ->add('productPrice', null, [
                'label' => 'Prix du produit'
            ], DecimalType::class)
            // ->add('productPrice', ChoiceType::class,[

            // ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'multiple' => false
            ])
            ->add('Image')
            // ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }

    // public function __construct (Category $category){
    //     $this->category = $category;
    // }

    // private function getCategoriesChoices()
    // {
    //     $getcategories = $this->category->getCategoryName();
    //     $output = [];
    //     foreach($getcategories as $k=>$v){
    //         $output[$v] = $k;
    //     }
    //     return $output;
    // }
    // private function getChoices()
    // {
    //     $choices = Product::PRICE;
    //     $output = [];
    //     foreach($choices as $k =>$v)
    //     {
    //         $output[$v] = $k;
    //     }
    //     return $output;
    // }
}
