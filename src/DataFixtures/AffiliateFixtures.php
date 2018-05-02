<?php

namespace App\DataFixtures;

use App\Entity\Affiliate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class AffiliateFixtures extends Fixture implements DependentFixtureInterface
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
            $affiliate = new Affiliate();
            $affiliate->setUrl($faker->url);
            $affiliate->setEmail($faker->email);
            $affiliate->setToken($faker->password(6, 24));
            $affiliate->setActive($faker->boolean);
//            $affiliate->addCategoryId($this->getReference('categoryId_' . $i));
            $affiliate->addCategoryId($this->getReference('category_' . $i));
            $manager->persist($affiliate);
        }

        $manager->flush();
    }


    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
