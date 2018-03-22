<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',TextType::class,
                [
                    'label'=>'nom'
                ]
        )
            ->add('firstname', TextType::class,
                [
                    'label'=>'prénom'
                ]
        )
            ->add('email', EmailType::class,
                [
                    'label'=>'Email'
                ]
        )
                //Le mot de passe en clair que l'on ne va pas stocker en BDD
            ->add('plainPassword',
                    //2 champs qui doivent être identiques
                    RepeatedType::class,
                    [
                        //type de mdp
                        'type'=> PasswordType::class,
                        'first_options'=>[
                            'label'=>'Mot de passe'
                        ],
                        'second_options'=>[
                            'label'=>'confirmation de votre mot de passe'
                        ]
                    ])    
                
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
