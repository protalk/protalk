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
 * Protalk\MediaBundle\Entity\MediaTag
 *
 * @ORM\Table(name="media_tag")
 * @ORM\Entity()
 *
 */
class MediaTag
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
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="tags")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;

    /**
     * @var integer $tag_id
     *
     * @ORM\Column(name="tag_id", type="integer")
     */
    private $tag_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="medias")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    protected $tag;

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
     * Set tag
     *
     * @param \Protalk\MediaBundle\Entity\Tag $tag
     */
    public function setTag(\Protalk\MediaBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;
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
     * Get tag
     *
     * @return \Protalk\MediaBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
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
     * Set tag_id
     *
     * @param integer $tagId
     */
    public function setTagId($tagId)
    {
        $this->tag_id = $tagId;
    }

    /**
     * Get tag_id
     *
     * @return integer
     */
    public function getTagId()
    {
        return $this->tag_id;
    }
    
    public function __toString() 
    {
        return $this->tag->getName();
    }
}