<?php

namespace App\DataFixtures;

use App\Entity\Zoo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ZooFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      // $zoo1 = new Zoo();
      // $zoo1->setName('Zoo de Paris')
      //      ->setAddress('Route de la Trinité, 75012 Paris')
      //      ->setCapacity(500)
      //      ->setFoundedYear(1934)
      //      ->setDescription('Un zoo historique au cœur de Paris');
      
      // $manager->persist($zoo1);
      // $manager->flush();
    }
}
