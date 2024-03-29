<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $category = new Category();
        // $manager->persist($category);

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++)
        {
            $category = new Category();
            $category
                ->setCategoryName($faker->words(4, true))
                ->setCategoryDescription($faker->sentences(2, true))
                ;

            $manager->persist($category);
        }
        
        $manager->flush();
    }
}
