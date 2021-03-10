<?php

// namespace App\DataFixtures;

// use App\Entity\User;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// class UserFixtures extends Fixture
// {
//     /**
//      * @var UserPasswordInterface
//      */
//     private $userPasswordEncoder;

//     public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
//     {
//         $this->userPasswordEncoder = $userPasswordEncoder;
//     }

//     public function load(ObjectManager $manager)
//     {
//         // $product = new Product();
//         // $manager->persist($product);
        
//         $user = new User();
//         $user->setNom('DemoLastName');
//         $user->setPrenom('DemoFirstName');
//         $user->setEmail('demo@gmail.com');
//         $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'demo'));
//         $user->setUsername('demo');
//         $manager->persist($user);
//         $manager->flush();
//     }
// }
