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
 * Protalk\MediaBundle\Entity\MediaLanguageCategory
 *
 * @ORM\Table(name="media_language_category")
 * @ORM\Entity()
 *
 */
class MediaLanguageCategory
{
    /**
     * @var integer $media_id
     *
     * @ORM\Column(name="media_id", type="integer")
     * @ORM\Id
     */
    private $media_id;

    /**
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="speakers")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;

    /**
     * @var integer $languagecategory_id
     *
     * @ORM\Column(name="languagecategory_id", type="integer")
     * @ORM\Id
     */
    private $languagecategory_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="LanguageCategory", inversedBy="medias")
     * @ORM\JoinColumn(name="languagecategory_id", referencedColumnName="id")
     */
    protected $languagecategory;

    /**
     * Set media
     *
     * @param \Protalk\MediaBundle\Entity\Media $media
     */
    public function setMedia(\Protalk\MediaBundle\Entity\Media $media)
    {
        $this->media = $media;
    }

    /**
     * Set languagecategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     */
    public function setSpeaker(\Protalk\MediaBundle\Entity\LanguageCategory $languageCategory)
    {
        $this->languagecategory = $languageCategory;
    }

    /**
     * Get media
     *
     * @return \Protalk\MediaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
    
    /**
     * Get languagecategory
     *
     * @return \Protalk\MediaBundle\Entity\LanguageCategory
     */
    public function getLanguageCategory()
    {
        return $this->languagecategory;
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
     * Set languagecategory_id
     *
     * @param integer $languageCategoryId
     */
    public function setLanguageCategoryId($languageCategoryId)
    {
        $this->languagecategory_id = $languageCategoryId;
    }

    /**
     * Get languagecategory id
     *
     * @return integer
     */
    public function getLanguageCategoryId()
    {
        return $this->languagecategory_id;
    }
    
    public function __toString() 
    {
        return $this->languagecategory->getCategory()->getName().' ('.$this->languagecategory->getLanguage()->getName().')';
    }
}