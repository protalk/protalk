<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Media_category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Media_category
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $media_id
     *
     * @ORM\Column(name="media_id", type="integer")
     */
    private $media_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="categories")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;

    /**
     * @var integer $category_id
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $category_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="medias")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set media_id
     *
     * @param integer $mediaId
     */
    public function setMediaId($mediaId)
    {
        $this->media_id = $mediaId;
    }

    /**
     * Get media_id
     *
     * @return integer 
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Set category_id
     *
     * @param integer $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set media
     *
     * @param Protalk\MediaBundle\Entity\Media $media
     */
    public function setMedia(\Protalk\MediaBundle\Entity\Media $media)
    {
        $this->media = $media;
    }

    /**
     * Get media
     *
     * @return Protalk\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set category
     *
     * @param Protalk\MediaBundle\Entity\Category $category
     */
    public function setCategory(\Protalk\MediaBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Protalk\MediaBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}