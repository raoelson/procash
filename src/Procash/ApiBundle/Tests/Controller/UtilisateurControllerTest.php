<?php

namespace Procash\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
    public function testGetuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getUser');
    }

}
