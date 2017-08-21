<?php

namespace Procash\AdministrationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BanqueControllerTest extends WebTestCase {

    public function testIndex() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => 'admin',
            '_password' => 'admin',
        ));
        $client->submit($form);

        $crawler = $client->request(
                'POST', '/referentiel/banques', array("banque" => array(
                "id" => 53,
                "code" => "Banque_Code_" . mt_rand(0, 99999),
                "libelle" => "Banque_Libelle_" . mt_rand(0, 99999),
                "refExterne" => "Banque_Ref_Externe_" . mt_rand(0, 99999),
                "supprimer" => "Valider"
            )
                )
        );
    }

}
