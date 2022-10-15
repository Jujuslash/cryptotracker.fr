<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    #[Route('/chart', name: 'app_chart')]
    public function index(): Response
    {
        return $this->render('chart/index.html.twig', [
            'controller_name' => 'ChartController',
        ]);
    }
#public function chartjs(ChartBuilderInterface $chartBuilder): Response
#    {
#       $chart = $chartBuilder->createChart(Chart::TYPE_LINE);#}
#
#        $chart->setData([
#            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
#            'datasets' => [
#                ['label' => 'Cookies eaten 🍪', 'data' => [2, 10, 5, 18, 20, 30, 45]],
#                ['label' => 'Km walked 🏃‍♀️', 'data' => [10, 15, 4, 3, 25, 41, 25]],
#            ],
#        ]);
#        return $this->render('chart/index.html.twig', [
#            'chart' => $chart,
#       ]);
#   }
}
