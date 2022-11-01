<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Form\AdminType;
use App\Repository\CryptoRepository;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, CryptoRepository $cryptoRepository, EntityManagerInterface $entityManager): Response
    {
        $crypto = new Crypto();
        $form = $this->createForm(AdminType::class, $crypto);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $data = $form->getData(); // une fois le formulaire submit on recupere ce quil y a dans data
            $quantityData = $data->getQuantity();
            $cryptoData = $data->getCrypto();
            $cryptoRepo = $cryptoRepository->findBy(['crypto' => $cryptoData]);
            $cryptoRepo[0]->setQuantity($quantityData);
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
            if ($cryptoData === 'Ripple')
            {
                $cryptoData= 'XRP';
            }
            $key = array_search($cryptoData, array_column($fullList, 'name'));
            $unitPrice = $fullList[$key]['quote']['EUR']['price'];
            $totalPrice = $unitPrice*$quantityData;
            $cryptoRepo[0]->setPrice($totalPrice);
            $entityManager->flush();
            //var_dump($cryptoRepo);
        }

        return $this->render('admin/index.html.twig',[
            'form'=>$form -> createView()
        ]);
    }
}
