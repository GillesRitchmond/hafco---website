<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', null, [
                'label' => 'Nom du produit'
            ])
            ->add('productDescription', null, [
                'label' => 'Description du produit'
            ])
            ->add('productPrice', null, [
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
}
