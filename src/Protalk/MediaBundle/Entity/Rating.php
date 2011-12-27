<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Rating
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\RatingRepository")
 */
class Rating
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
     * @var string $ipaddress
     *
     * @ORM\Column(name="ipaddress", type="string", length=15)
     */
    private $ipaddress;

    /**
     * @var integer $rating
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;


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
     * Set ipaddress
     *
     * @param string $ipaddress
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;
    }

    /**
     * Get ipaddress
     *
     * @return string 
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
}