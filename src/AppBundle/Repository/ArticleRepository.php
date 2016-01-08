<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Interfaces\ArticleRepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ArticleRepository implements ArticleRepositoryInterface {
    
     /**
     *
     * @var EntityManager 
     */
    protected $em;
    
    protected $formFactory;

    public function __construct(EntityManager $EntityManager , $formFactory)
    {
        $this->formFactory = $formFactory;
        
        $this->em = $EntityManager;
    }
    
    public function createArticle(\AppBundle\Entity\Article $Article ) {
        
        $this->em->persist($Article);
        $this->em->flush();
        return $Article;
        
    }
    
    public function createFormBuilder(\AppBundle\Entity\Article $Article){
        
        $builder = $this->formFactory->createBuilder(FormType::class, $Article , array());
        
        $builder
            ->add('title', TextType::class)
            ->add('slug' , TextType::class)
            ->add('content' , TextareaType::class)
            ->add('created' , DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ))
            
            ->add('updated' , DateTimeType::class , 
                array (
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd HH:mm:ss'
                )
            )
        ;
        
        return $builder;
    }
    
    public function editArticle( $Article ) {
        $Article->setUpdated( new \DateTime("now"));
        $this->em->persist($Article);
        $this->em->flush();
        return $Article;
        
    }
    
    public function deleteArticle( $Article ) {
        
    }
    
    public function enableArticle( $Article ) {
        
    }
    
    public function disableArticle( $Article ) {
        
    }
    
    public function getArticleById ( $Id ) {
        
        $article = $this->em->getRepository('AppBundle:Article')->findOneBy(array('id' => $Id));
        
        if(!$article) {
            throw new \Exception("[".__METHOD__."] - " . 'Article was not found.');
        }
        return $article;
        
    }
}