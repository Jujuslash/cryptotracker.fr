<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function bitcoin(): Response
    {
        $client1 = HttpClient::create();
        $response = $client1->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=1',
         [
            'headers' =>
            [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY' => '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $bitcoin = $response->toArray()["data"];
        /* return $cryptos;*/

       $client2 = HttpClient::create();
        $response2 = $client2->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=1027', [
            'headers' => [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY' => '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $ethereum = $response2->toArray()["data"];
        /* return $cryptos;*/



        $client3 = HttpClient::create();
        $response3 = $client3->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=52', [
            'headers' => [
               'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY'=> '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
         ]);
        $xrp = $response3->toArray()["data"];
        /* return $cryptos;*/
        return $this->render('requester/index.html.twig', [
            'xrp_template' => $xrp,   /*var twig = var php*/
            'ethereum_template' => $ethereum,   /*var twig = var php*/
            'bitcoin_template' => $bitcoin,   /*var twig = var php*/
        ]);
    }
}
