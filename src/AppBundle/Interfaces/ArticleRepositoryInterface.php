<?php

namespace AppBundle\Interfaces;

interface ArticleRepositoryInterface {
    
    /**
     * 
     */
    public function createArticle( \AppBundle\Entity\Article $Article );
    
    /**
     * 
     */
    public function editArticle( $Article );
    
    /**
     * 
     */
    public function deleteArticle( $Article );
    
    /**
     * 
     */
    public function enableArticle( $Article );
    
    /**
     * 
     */
    public function disableArticle( $Article );
    
    /**
     * Finds an article by its id
     */
     public function getArticleById($Id);
    
}