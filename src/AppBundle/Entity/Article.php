<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "The title minimum length is {{ limit }} characters long",
     *      maxMessage = "The title cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "The slug minimum length is {{ limit }} characters long",
     *      maxMessage = "The slug cannot be longer than {{ limit }} characters"
     * )
     * 
     * @ORM\Column(type="string", length=100)
     */
    protected $slug;
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    
    /**
     * 
     */
    private $cover;
    
    public function __construct(){
        $this->created = new \DateTime("now");
        $this->updated = new \DateTime("now");
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getSlug(){
        return $this->slug;
    }
    
    public function getContent(){
        return $this->content;
    }
    
    public function getCreated(){
        return $this->created;
    }
    
    public function getUpdated(){
        return $this->updated;
    }
    
    public function getCover(){
        return $this->cover;
    }
    
    public function setId($Id){
        $this->id = $Id;
    }
    
    public function setTitle($Title){
        $this->title = $Title;
    }
    
    public function setSlug($Slug){
        $this->slug = $Slug;
    }
    
    public function setContent($Content){
        $this->content = $Content;
    }
    
    public function setCreated($Created){
        $this->created = $Created;
    }
    
    public function setUpdated($Updated){
        $this->updated = $Updated;
    }
    
    public function setCover($Cover){
        $this->cover = $Cover;
    }
}