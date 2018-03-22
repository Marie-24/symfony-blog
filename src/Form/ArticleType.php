<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'title',
                    TextType::class,
                    [
                        'label'=>'Titre'
                    ]
                    
                    )
            ->add(
                    'content',
                    TextareaType::class,
                    [
                        'label'=>'Contenu'
                    ]
                    
                    )
            ->add(
                    'description',
                    TextareaType::class,
                    [
                        'label'=>'Description'
                    ]
                    
                    )
            ->add(
                    'category',
                    //select sur une entité
                    EntityType::class,
                    [
                        'label'=>'Catégorie',
                        'class'=> Category::class,
                        //nom du champ qui s'affiche dans les options
                        'choice_label'=>'name',
                        //1re option vide
                        'placeholder'=>'choisissez une catégorie'
                    ]
                  )
            ->add(
                    'image',
                    //select sur une entité
                    FileType::class,
                    [
                        'label'=>'Illustration',
                       'required'=>false
                    ]
                  )
                
        ;
        //option ['data'] = l'entité de l'article
        if(!is_null($options['data']->getImage())){
        $builder->add(
                'remove_image',
                CheckboxType::class,
                [
                    'label'=>"Supprimer l'illustration",
                    'required'=>false,
                    // champ non relié à l'attribut de l'entité Article
                    'mapped'=>false
                ]
                );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
         'data_class' => Article::class,
        ]);
    }
}
