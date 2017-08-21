<?php

namespace Procash\AdministrationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DelaiFermetureControllerTest extends WebTestCase
{
    public function testAjouter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajouter');
    }

}
