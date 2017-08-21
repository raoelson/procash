<?php

namespace Procash\AdministrationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilControllerTest extends WebTestCase
{
    public function testListe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/liste');
    }

    public function testAjouter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouter');
    }

    public function testModifier()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modifier');
    }

}
