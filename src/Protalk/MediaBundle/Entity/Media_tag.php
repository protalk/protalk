<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Media_tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Media_tag
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
     * Set tag
     *
     * @param Protalk\MediaBundle\Entity\Tag $tag
     */
    public function setTag(\Protalk\MediaBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag
     *
     * @return Protalk\MediaBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}