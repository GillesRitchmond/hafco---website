<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++)
        {
            $product = new Product();
            $product
                ->setProductName($faker->words(4, true))
                ->setProductDescription($faker->sentences(4, true))
                ->setProductPrice($faker->numberBetween(0, 3000000))
                ->setImage($faker->imageUrl(300, 260, 'food'))
                ;

            $manager->persist($product);
        }
        
        $manager->flush();
    }
}
