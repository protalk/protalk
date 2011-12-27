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
     * @var integer $tag_id
     *
     * @ORM\Column(name="tag_id", type="integer")
     */
    private $tag_id;


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
}