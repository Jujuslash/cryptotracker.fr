<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HistoriqueRepository;

class GraphController extends AbstractController
{
 #[Route('/graph', name: 'app_graph')]
    public function index(HistoriqueRepository $historiqueRepository): Response
    {
        $total = $historiqueRepository ->findDates();
        Foreach ($total as $resp)
        {
            $tab[] = $resp->getTotal();
            $tabx[] = $resp->getId();
        }

        return $this->render('graph/Total.html.twig', [

            'total_data' => $tab,   /*var twig = var php*/
            'total_time' => $tabx,
        ]);
    }

    #[Route('/bit_graph')]
    public function bitcoin(): Response
    {
        $client1 = HttpClient::create();
        $response = $client1->request('GET', 'https://rest.coinapi.io/v1/quotes/BITSTAMP_SPOT_BTC_EUR/history?time_start=2022-10-01T00:00:00',
        [
            'headers' =>
            [
                'content-type' => 'application/json',
                'X-CoinAPI-Key' => 'D02ABC13-B3C3-4612-9919-219864732C50'
            ],
        ]);
        //var_dump($response);
        $tab = [];
        $tabx =[];
        $i=0;
        Foreach ($response->toArray() as $resp)
        {
        $tab[] = $resp["ask_price"];
        $tabx[] = ++$i;
        }
        $bitcoin = $response->toArray();
        return $this->render('graph/index.html.twig', [
            'bitcoin_data' => $tab,   /*var twig = var php*/
            'bitcoin_time' => $tabx,
        ]);
    }

    #[Route('/ether_graph')]
    public function ethereum(): Response
    {
        $client2 = HttpClient::create();
        $response = $client2->request('GET', 'https://rest.coinapi.io/v1/quotes/bitstamp_SPOT_eth_eur/history?time_start=2022-10-10T00:00:00',
            [
                'headers' =>
                    [
                        'content-type' => 'application/json',
                        'X-CoinAPI-KEY' => 'BB684089-080B-4D01-97AC-AEE16C2FA8BF'
                    ],
            ]);
        $tabeth = [];
        $tabethx = [];
        $i = 0;
        Foreach ($response->toArray() as $resp)
        {
            $tabeth[] = $resp["ask_price"];
            $tabethx[] = ++$i;
        }
        $bitcoin = $response->toArray();

        return $this->render('graph/ethereum.html.twig', [
            'bitcoin_data' => $tabeth,   /*var twig = var php*/
            'bitcoin_time' => $tabethx,
        ]);
    }

    #[Route('/xrp_graph')]
    public function xrp(): Response
    {
        $client3 = HttpClient::create();
        $response = $client3->request('GET', 'https://rest.coinapi.io/v1/quotes/bitstamp_SPOT_eth_eur/history?time_start=2022-10-11T00:00:00',
            [
                'headers' =>
                [
                    'content-type' => 'application/json',
                    'X-CoinAPI-KEY' => 'BB684089-080B-4D01-97AC-AEE16C2FA8BF'
                ],
            ]);
        # https://www.coingecko.com/fr/api/documentation
        $tabxrp = [];
        $tabxrpx = [];
        $i = 0;
        Foreach ($response->toArray() as $resp)
        {
            $tabxrp[] = $resp["ask_price"];
            $tabxrpx[] = ++$i;
        }
        $xrp = $response->toArray();

        return $this->render('graph/xrp.html.twig', [
            'xrp_data' => $tabxrp,   /*var twig = var php*/
            'xrp_time' => $tabxrpx,
        ]);
    }
}
