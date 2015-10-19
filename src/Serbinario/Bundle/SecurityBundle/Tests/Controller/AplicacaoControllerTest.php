<?php

namespace Serbinario\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AplicacaoControllerTest extends WebTestCase
{
    public function testSave()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'saveAplicacao');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'updateAplicacao');
    }

    public function testGrid()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'gridAplicacao');
    }

}
