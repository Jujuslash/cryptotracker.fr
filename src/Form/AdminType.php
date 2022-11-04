<?php

namespace App\Form;

use App\Entity\Crypto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('crypto', ChoiceType::class, [
                'choices' => ['Bitcoin'=>'Bitcoin' ,'Ethereum'=>'Ethereum','Ripple'=>'Ripple'],
                'placeholder'=> 'Crypto'
            ])
            ->add('quantity', NumberType::class, [
                'attr' => ['placeholder' => 'Quantité']])
            ->add('submit', SubmitType::class, ['label' => 'VALIDER'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Crypto::class,
        ]);
    }
}
