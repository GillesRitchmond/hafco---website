<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null,[
                'label' => 'Prénom',
                'required' => true
            ], TextType::class)
            ->add('lastname', null,[
                'label' => 'Nom',
                'required' => true
            ], TextType::class)
            ->add('phone', null,[
                'label' => 'Téléphone',
                'required' => true
            ], TextType::class)
            ->add('email', null,[
                'label' => 'Email',
                'required' => true
            ], TextType::class)
            ->add('message', null,[
                'label' => 'Message',
                // 'placeholder' => 'Tapez votre message',
                'required' => true
            ], TextAreaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
