<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('firstname', TextType::class, [

                'label'=>'Votre Prénom bogosse',
                'constraints'=> new Length ([
                    'min' => 2,
                    'max' => 30,
                ]),
                'attr'=> [
                    'placeholder'=>'Azy laisse'
                ]

            ])
            ->add('lastname', TextType::class,
            [
                'label'=>'Nom de famille fdp',
                'constraints'=> new Length ([
                    'min' => 2,
                    'max' => 30,
                ]),
                "attr"=>[
                    'placeholder'=> 'Influenceur crypto'
                ]
            ])
            ->add('email', EmailType::class, 
            [
                'label'=>'Ton email ',
                "attr"=>[
                    'placeholder'=> 'Pour recevoir tes cryptos'
                ]
            ])
            ->add('password', RepeatedType::class, 
            [
                'type' => PasswordType::class,
                'invalid_message' =>'Le mot de passe et confirmation identique',
                'label'=>'Ton Mot de passe ',
                'required' => true,
                'first_options'=>['label'=>'mdp'],
                'second_options'=>['label'=>'confirme']
            
                
            ])
            
              -> add('submit', SubmitType::class, [

                'label' => "Inscrit toi pour plus d'astuces"
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=>User::class,
            
        ]);
    }
}
