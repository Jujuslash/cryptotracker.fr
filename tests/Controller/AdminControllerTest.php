<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AdminControllerTest extends WebTestCase
{
    public function testAddType()

    {

         $client = static::createClient();
         $crawler = $client->request('GET', '/admin');
         $form = $crawler->selectButton('admin_submit')->form(
         ['admin[quantity]' => '1',
         'admin[crypto]' => 'Bitcoin']);
         $client->submit($form);
         $crawler = $client->followRedirects();
         $this->assertSame(1, $crawler->filter('.text-success')->count());
    }
}