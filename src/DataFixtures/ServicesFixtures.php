<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i < 100; $i++) {
            $service = new Services();
            $service
                ->setName($faker->words(3, true))
                ->setDescription($faker->words(8, true))
                ->setPriceInitial($faker->numberBetween(10000, 50000))
                ->setPriceSpecial($faker->numberBetween(50000, 100000))
                ->setDuree($faker->numberBetween(1, 8))
                ->setCreatedBy($faker->numberBetween(1,5))
                ->setCodeService($faker->numberBetween(1, 300))
                ->setQuantityMax($faker->numberBetween(1,5))
                ->setValidite($faker->numberBetween(1, 5));
                // ->addCommande($faker->randomElement(1,2));


            $manager->persist($service);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
