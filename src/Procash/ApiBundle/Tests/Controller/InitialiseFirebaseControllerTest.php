<?php

namespace Procash\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InitialiseFirebaseControllerTest extends WebTestCase
{
    public function testInitialise()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'initialiser-firebase');
    }

}
