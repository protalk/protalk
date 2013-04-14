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
 * Protalk\MediaBundle\Entity\MediaSpeaker
 *
 * @ORM\Table(name="media_speaker")
 * @ORM\Entity()
 *
 */
class MediaSpeaker
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
     * @var integer $speaker_id
     *
     * @ORM\Column(name="speaker_id", type="integer")
     * @ORM\Id
     */
    private $speaker_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Speaker", inversedBy="medias")
     * @ORM\JoinColumn(name="speaker_id", referencedColumnName="id")
     */
    protected $speaker;

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
     * Set speaker
     *
     * @param \Protalk\MediaBundle\Entity\Speaker $speaker
     */
    public function setSpeaker(\Protalk\MediaBundle\Entity\Speaker $speaker)
    {
        $this->speaker = $speaker;
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
     * Get speaker
     *
     * @return \Protalk\MediaBundle\Entity\Speaker
     */
    public function getSpeaker()
    {
        return $this->speaker;
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
     * Set speaker_id
     *
     * @param integer $speakerId
     */
    public function setSpeakerId($speakerId)
    {
        $this->speaker_id = $speakerId;
    }

    /**
     * Get speaker_id
     *
     * @return integer
     */
    public function getSpeakerId()
    {
        return $this->speaker_id;
    }
    
    public function __toString() 
    {
        return $this->speaker->getName();
    }
}