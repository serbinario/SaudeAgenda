<?php

namespace Serbinario\Bundle\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PermissaoControllerTest extends WebTestCase
{
    public function testSave()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'savePermissao');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'UpdatePermissao');
    }

    public function testGrid()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'gridPermissao');
    }

}
