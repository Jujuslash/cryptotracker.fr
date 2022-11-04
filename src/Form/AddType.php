<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
        $unitPrices = [];
        $fullList = $response->toArray()['data'];
        for($i =0;$i<10;$i++)
        {
            if($fullList[$i]['name'] === 'Bitcoin' || $fullList[$i]['name'] === 'Ethereum' || $fullList[$i]['name'] === 'XRP')
            {
               $id = $fullList[$i]['id'];
                $unitPrice = $fullList[$i]['quote']['EUR']['price'];
                array_push($unitPrices,$unitPrice);
            }
        }
        $builder

            ->add('crypto', ChoiceType::class, [
                'choices' => ['Bitcoin'=>'Bitcoin','Ethereum'=>'Ethereum','Ripple'=>'Ripple'],
                'choice_attr'=>
                    [
                    'Bitcoin'=>['data-price'=>$unitPrices[0]],
                    'Ethereum'=>['data-price'=>$unitPrices[1]],
                    'Ripple'=>['data-price'=>$unitPrices[2]]
                    ],
                'placeholder'=> 'Crypto'
            ])
            ->add('quantity', NumberType::class, [
                'attr' => ['placeholder' => 'Quantité']])
            ->add('price', TextType::class,
                ['attr' => ['placeholder' => 'Prix en €','readonly' => 'true']],
                )
            ->add('submit', SubmitType::class, ['label' => 'AJOUTER'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
