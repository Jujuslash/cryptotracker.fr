<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Form\AddType;
use App\Repository\CryptoRepository;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Historique;
use App\Repository\HistoriqueRepository;

class ChartController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function index(Request $request,HistoriqueRepository $historiqueRepository, CryptoRepository $cryptoRepository, EntityManagerInterface $entityManager): Response
    {
        $historique = new Historique();
        $crypto = new Crypto();
        $client1 = HttpClient::create();
        $response = $client1->request('GET', 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
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
        $fullList = $response->toArray()['data'];
        $form = $this->createForm(AddType::class, $crypto);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $data = $form->getData(); // une fois le formulaire submit on recupere ce quil y a dans data

            $quantityData = $data->getQuantity();
            $cryptoData = $data->getCrypto();
            $cryptoRepo = $cryptoRepository->findBy(['crypto' => $cryptoData]);
            $total = $historiqueRepository->findLastDate();
            $totalCrypto = $cryptoRepo[0]->getPrice();
            //var_dump($total[0]->getTotal());
            $totalTotal = $total[0]->getTotal();
            $qtyCrypto = $cryptoRepo[0]->getQuantity();
            $cryptoRepo[0]->setQuantity($quantityData+$qtyCrypto);

            if ($cryptoData === 'Ripple')
            {
                $cryptoData= 'XRP';
            }
            $key = array_search($cryptoData, array_column($fullList, 'name'));
            $unitPrice = $fullList[$key]['quote']['EUR']['price'];
            $totalPrice = $unitPrice*$quantityData;
            $cryptoRepo[0]->setPrice($totalPrice+$totalCrypto);
            $historique->setTotal($totalPrice+$totalTotal);
            $entityManager->persist($historique);
            $entityManager->flush();
        }

        return $this->render('chart/index.html.twig',[
        'form'=>$form -> createView()
        ]);
    }
}
