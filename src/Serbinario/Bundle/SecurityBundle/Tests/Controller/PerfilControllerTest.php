<?php

namespace Serbinario\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PerfilControllerTest extends WebTestCase
{
    public function testSave()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'savePerfil');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'updateAction');
    }

    public function testGrid()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'gridPerfil');
    }

}
