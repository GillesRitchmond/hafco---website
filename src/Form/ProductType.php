<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
                'label' => 'Description du produit',
                'row_attr' => ['class' => 'textarea']
            ], TextareaType::class)
            ->add('productPrice', null, [
                'label' => 'Prix du produit'
            ], DecimalType::class)
            ->add('imageFile', VichImageType::class,[
                'required' => true,
                'row_attr' => ['class' => 'custom-file-input']
            ])  
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'multiple' => false,
                'attr' => [
                    'class' => 'Ex: meuble de bureau'
                ]
            ])
            //->add('Image')
            // ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
