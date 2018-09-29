<?php

namespace Blog\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('dateParution')
            ->add('description')
            ->add('auteur')
            ->add('etatPublication', CheckboxType::class, array('label' => 'voulez vous publier article si oui confirmer'
            ))
            ->add('categorie')
            //, EntityType::class, [
              //  'class'    => 'Blog\BlogBundle\Entity\Categorie',
               // 'label'    => 'Categorie',                
               // 'multiple' => true,
               // 'expanded' => true
           // ])
           
                
            ->add('image', fileType::class, array('label'=>'insert une image'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\BlogBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blog_blogbundle_article';
    }


}
