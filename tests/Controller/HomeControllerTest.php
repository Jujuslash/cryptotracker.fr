<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class HomeControllerTest extends WebTestCase
{
    public function testRoutes()
    {
        $client=static ::createClient();
        $urls =['/','/admin','/add','/graph'];
        foreach ($urls as $url)
        {
            $client->request('GET', $url);
            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }
    }
}
