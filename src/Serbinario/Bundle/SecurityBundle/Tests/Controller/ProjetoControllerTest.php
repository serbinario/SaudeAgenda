<?php

namespace Serbinario\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetoControllerTest extends WebTestCase
{
    public function testSave()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'saveProjeto');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'updateProjeto');
    }

    public function testGrid()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'gridProjetos');
    }

}
