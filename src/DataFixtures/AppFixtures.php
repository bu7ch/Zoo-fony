<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Zoo;
use App\Entity\Animal;
use App\Entity\Famille;
use App\Entity\Continent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create();

    // Créer des continents
    $continents = [];
    foreach (['Afrique', 'Europe', 'Asie', 'Amérique', 'Océanie'] as $continentName) {
      $continent = new Continent();
      $continent->setName($continentName);
      $manager->persist($continent);
      $continents[] = $continent;
    }

    // Créer des familles
    $familles = [];
    foreach (['Mammifères', 'Reptiles', 'Oiseaux', 'Poissons', 'Amphibiens'] as $familleName) {
      $famille = new Famille();
      $famille->setName($familleName);
      $manager->persist($famille);
      $familles[] = $famille;
    }

    // Créer des zoos
    $zoos = [];
    for ($i = 1; $i <= 5; $i++) {
      $zoo = new Zoo();
      $zoo->setName('Zoo ' . $i)
        ->setAddress($faker->address)
        ->setCapacity($faker->numberBetween(50, 500))
        ->setFoundedYear($faker->year);
      $manager->persist($zoo);
      $zoos[] = $zoo;
    }

    // Créer des animaux
    for ($i = 1; $i <= 50; $i++) {
      $animal = new Animal();
      $animal->setName($faker->firstName . ' ' . $faker->lastName)
        ->setImageUrl($faker->imageUrl(400, 400, 'animals', true))
        ->setDangerous($faker->boolean(30)) // 30% de chance d'être dangereux
        ->setContinent($faker->randomElement($continents))
        ->setFamille($faker->randomElement($familles))
        ->setZoo($faker->randomElement($zoos));

      $manager->persist($animal);
    }

    $manager->flush();
  }
}
