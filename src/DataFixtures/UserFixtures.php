<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    for($i = 0 ; $i < 5; $i++){
      $user = new User();
      $user->setEmail('test@example.fr')
          ->setRoles(['ROLE_ADMIN'])
          ->setPassword("123456")
          ->setUsername('UserTest');

      $manager->persist($user);
      
    }
    $manager->flush();
  }
}