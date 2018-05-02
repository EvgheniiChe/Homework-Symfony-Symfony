<?php

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName(ucfirst($faker->word));
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }

}
