<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class RequesterController extends AbstractController
{
    #[Route('/requester', name: 'app_requester')]
    public function index(): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info?id=1,1027,52', [
            'headers' => [
                'content-type' => 'application/json',
                'X-CMC_PRO_API_KEY'=> '904d0623-35e7-4ef2-8c5a-d4b453c7b78b'
            ],
        ]);
        $cryptos = $response->toArray()["data"];
       /* return $cryptos;*/
        return $this->render('requester/index.html.twig', [
            'cryptostemplate' => $cryptos,   /*var twig = var php*/
            'developer' => "Julien et Mica"
        ]);
    }
}



/*/cryptocurrency/latest   id=1 Bitcoin id=1027 Ethereum id=52 XRP*/

/*/cryptocurrency/historical*/