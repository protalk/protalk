<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Media_speaker
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Media_speaker
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
     * @var integer $speaker_id
     *
     * @ORM\Column(name="speaker_id", type="integer")
     */
    private $speaker_id;

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
}