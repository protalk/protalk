<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Protalk\MediaBundle\Entity\LanguageCategory
 *
 * @ORM\Table(name="languageCategory")
 * @ORM\Entity()
 *
 */
class LanguageCategory
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var integer $language_id
     *
     * @ORM\Column(name="language_id", type="integer")
     */
    private $language_id;

    /**
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="languageCategories")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    protected $language;

    /**
     * @var integer $category_id
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $category_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="languageCategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var ArrayCollection $medias
     *
     * @ORM\OneToMany(targetEntity="MediaLanguageCategory", mappedBy="languageCategory")
     */
    private $medias;
    
    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

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
     * Set category
     *
     * @param \Protalk\MediaBundle\Entity\Category $category
     */
    public function setCategory(\Protalk\MediaBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Set language
     *
     * @param \Protalk\MediaBundle\Entity\Language $language
     */
    public function setLanguage(\Protalk\MediaBundle\Entity\Language $language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return \Protalk\MediaBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * Get category
     *
     * @return \Protalk\MediaBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Set language_id
     *
     * @param integer $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->language_id = $languageId;
    }

    /**
     * Get language_id
     *
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->language_id;
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
    
    public function __toString() 
    {
        return $this->category->getName().' ('.$this->language->getName().')';
    }

    /**
     * Add medias
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $medias
     * @return LanguageCategory
     */
    public function addMedia(\Protalk\MediaBundle\Entity\MediaLanguageCategory $medias)
    {
        $this->medias[] = $medias;
    
        return $this;
    }

    /**
     * Remove medias
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $medias
     */
    public function removeMedia(\Protalk\MediaBundle\Entity\MediaLanguageCategory $medias)
    {
        $this->medias->removeElement($medias);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedias()
    {
        return $this->medias;
    }
}