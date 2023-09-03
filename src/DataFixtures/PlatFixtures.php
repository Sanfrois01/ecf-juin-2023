<?php

namespace App\DataFixtures;

use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    for($i = 0 ; $i < 5; $i++){
      $plat = new Plat();
      $plat->setNomPlat('Plat #1')
          ->setDescriptionPlat('Description #1')
          ->setImgPlat("image #1")
          ->setPrixPlat(1);

      $manager->persist($plat);
      
    }
    $manager->flush();
  }
}