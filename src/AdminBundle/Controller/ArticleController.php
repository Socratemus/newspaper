<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use AppBundle\Entity\Article;


class ArticleController extends Controller
{
    /**
     * @Route("/article/all", name="article-list")
     */
    public function indexAction(Request $request)
    {
        
        
        return $this->render('AdminBundle:admin:article/all.html.twig', array());
    }
    
    /**
     * @Route("/article/new", name="article-create")
     */
    public function newAction(Request $request)
    {
        $articleRepository = $this->get('app.repository.articlerep');
        $article = new Article();
        $article->setTitle('Default article title');

        $builder = $articleRepository->createFormBuilder($article);
        
        $form = $builder->getForm();
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            
            $article = $articleRepository->createArticle( $form->getData() );
            
            return $this->redirectToRoute('article-edit', array('id' => $article->getId()), 301);
        }
        
        return $this->render('AdminBundle:admin:article/edit.html.twig', array(
            'form' => $form->createView(),  
            'article' => $article
        ));
    }
    
    /**
     * @Route("/article/edit/{id}", name="article-edit")
     */
    public function editAction(Request $request , $id){
        
        $articleRepository = $this->get('app.repository.articlerep');
        
        $article = $articleRepository->getArticleById($id);
        $builder = $articleRepository->createFormBuilder($article);
    //     $builder = $this->createFormBuilder($article)
    //         ->add('title', TextType::class)
    //         ->add('slug' , TextType::class)
    //         ->add('content' , TextareaType::class)
    //         ->add('created' , DateTimeType::class, array(
    //             'widget' => 'single_text',
    //             'format' => 'yyyy-MM-dd HH:mm:ss'
    //         ))
            
    //         ->add('updated' , DateTimeType::class , 
    //             array (
    //                 'widget' => 'single_text',
    //                 'format' => 'yyyy-MM-dd HH:mm:ss'
    //             )
    //         )
    // ;
        
        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $articleRepository = $this->get('app.repository.articlerep');
            
            $article = $articleRepository->editArticle( $form->getData() );
            
            return $this->redirectToRoute('article-edit', array('id' => $article->getId()), 301);
        } 
        
        return $this->render('AdminBundle:admin:article/edit.html.twig', array(
            'form' => $form->createView(),    
            'article' => $article
        ));
    }
}