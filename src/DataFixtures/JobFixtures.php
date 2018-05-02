<?php

namespace App\DataFixtures;


use App\Entity\Job;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class JobFixtures extends Fixture implements DependentFixtureInterface
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
            $job = new Job();
            $job->setActivated(true);
            $job->setCategoryId($this->getReference('categoryId_' . $i));
            $job->setCompany($faker->company);
            $job->setDescription($faker->paragraph);
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTime);
            $job->setPublic($faker->boolean);
            $job->setToken($faker->password(6, 24));
            $job->setHowToApply($faker->paragraph);
            $job->setLocation($faker->city);
            $job->setPosition($faker->word);
            $job->setUrl($faker->url);
            $job->setLogo($faker->imageUrl());
            $job->setType($faker->jobTitle);
            $manager->persist($job);
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
