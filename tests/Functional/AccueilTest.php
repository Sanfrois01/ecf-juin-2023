<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccueilTest extends WebTestCase
{
    public function testAccueil(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $img = $crawler->selectImage('photo de cuisine');
        $this->assertEquals(2, count($img));



        $this->assertSelectorTextContains('h1', 'Bienvenue chez Quai Antique');
    }
}
