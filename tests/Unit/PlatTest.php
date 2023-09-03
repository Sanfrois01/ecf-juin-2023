<?php

namespace App\Tests\Unit;

use App\Entity\Plat;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlatTest extends KernelTestCase
{
    public function testEntityIsValid(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $plat = new Plat();
        $plat->setNomPlat('Plat #1')
            ->setDescriptionPlat('Description #1')
            ->setImgPlat("image #1")
            ->setPrixPlat(1);


        $errors = $container->get('validator')->validate($plat);

        $this->assertCount(0, $errors);
  }
}
