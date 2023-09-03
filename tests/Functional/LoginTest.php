<?php

namespace App\tests\Functional;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();

        /**
         * @var UrlGeneratorInterface $urlGenerator
         */

         $urlGenerator = $client->getContainer()->get('router');
         $crawler = $client->request('GET', $urlGenerator->generate('login'));
         $form = $crawler->filter('form[name=login]')->form([
            "_username" => "admin@example.fr",
            "_password" => "admin01"
         ]);
         $client->submit($form);
         $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
         $client->followRedirect();
         $this->assertRouteSame('login');

    }

    public function testLoginWithWrongPassword(): void
    {
        $client = static::createClient();

        /**
         * @var UrlGeneratorInterface $urlGenerator
         */

         $urlGenerator = $client->getContainer()->get('router');

         $crawler = $client->request('GET', $urlGenerator->generate('login'));

         $form = $crawler->filter('form[name=login]')->form([
            "_username" => "admin@example.fr",
            "_password" => "Test$$"
         ]);
         $client->submit($form);
         $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
         $client->followRedirect();
         $this->assertRouteSame('login');
         $this->assertSelectorTextContains("div.alert-danger", "Invalid credentials.");

    }
}
