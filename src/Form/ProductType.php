<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\DBAL\Types\DecimalType;
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
        $builder
            ->add('productName', null, [
                'label' => 'Nom du produit'
            ], TextType::class)
            ->add('productDescription', null, [
                'label' => 'Description du produit'
            ], TextareaType::class)
            // ->add('productPrice', null, [
            //     'label' => 'Prix du produit'
            // ], DecimalType::class)
            ->add('categories_id', ChoiceType::class,[

            ])
            ->add('productPrice', ChoiceType::class,['choices'=>$this->getChoices()], null, [
                'label' => 'Prix du produit'
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

    private function getCategoriesChoices(Category $category)
    {
        $getcategories = 
        $output = [];
        foreach($getcategories as $k=>$v){

        }
    }
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
