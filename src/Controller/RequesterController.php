<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class RequesterController extends AbstractController
{
    #[Route('/h', name: 'app_requester')]
    public function bitcoin(): Response
    {
        $client1 = HttpClient::create();
        $response = $client1->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=1', [
            'headers' => [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY' => '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $bitcoin = $response->toArray()["data"];
        /* return $cryptos;*/
        return $this->render('requester/index.html.twig', [
            'bitcoin_template' => $bitcoin,   /*var twig = var php*/
        ]);
    }

    public function ethereum(): Response
    {
        $client2 = HttpClient::create();
        $response = $client2->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=1027', [
            'headers' => [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY' => '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $ethereum = $response->toArray()["data"];
        /* return $cryptos;*/
        return $this->render('requester/index.html.twig', [
            'ethereum_template' => $ethereum,   /*var twig = var php*/

        ]);
    }

    public function xrp(): Response
    {
        $client3 = HttpClient::create();
        $response = $client3->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=52', [
            'headers' => [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY'=> '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $xrp = $response->toArray()["data"];
        /* return $cryptos;*/
        return $this->render('requester/index.html.twig', [
            'xrp_template' => $xrp,   /*var twig = var php*/

        ]);
    }

    public function arrow()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'headers' =>
                [
                    'content-type' => 'application/json',
                    'X-CMC_PRO_API_KEY' => '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
                ],
            'query' =>
                [
                    'convert' => 'EUR',
                    'limit' => 10
                ],
        ]);
        $changes = [];
        $fullList = $response->toArray()['data'];
        for($i =0;$i<10;$i++)
        {
            if($fullList[$i]['name'] === 'Bitcoin' || $fullList[$i]['name'] === 'Ethereum' || $fullList[$i]['name'] === 'XRP')
            {
                $id = $fullList[$i]['id'];
                $change = $fullList[$i]['quote']['EUR']['percent_change_24h'];
                array_push($changes,$change);
                return $this->render('requester/index.html.twig', [
                    'changes' => $changes,]);   /*var twig = var php*/

            }
        }
    }
}



/*/cryptocurrency/latest   id=1 Bitcoin id=1027 Ethereum id=52 XRP*/

/*/cryptocurrency/historical*/