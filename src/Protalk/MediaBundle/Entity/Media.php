<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Media
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\MediaRepository")
 */
class Media
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
     * @var integer $mediatype_id
     *
     * @ORM\Column(name="mediatype_id", type="integer")
     */
    private $mediatype_id;

    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $length
     *
     * @ORM\Column(name="length", type="string", length=10)
     */
    private $length;

    /**
     * @var float $rating
     *
     * @ORM\Column(name="rating", type="float")
     */
    private $rating;

    /**
     * @var integer $visits
     *
     * @ORM\Column(name="visits", type="integer")
     */
    private $visits;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string $slides
     *
     * @ORM\Column(name="slides", type="string", length=255)
     */
    private $slides;

    /**
     * @var integer $joindin
     *
     * @ORM\Column(name="joindin", type="integer")
     */
    private $joindin;

    /**
     * @var string $language
     *
     * @ORM\Column(name="language", type="string", length=2)
     */
    private $language;


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
     * Set mediatype_id
     *
     * @param integer $mediatypeId
     */
    public function setMediatypeId($mediatypeId)
    {
        $this->mediatype_id = $mediatypeId;
    }

    /**
     * Get mediatype_id
     *
     * @return integer 
     */
    public function getMediatypeId()
    {
        return $this->mediatype_id;
    }

    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set length
     *
     * @param string $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set rating
     *
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return float 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
    }

    /**
     * Get visits
     *
     * @return integer 
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slides
     *
     * @param string $slides
     */
    public function setSlides($slides)
    {
        $this->slides = $slides;
    }

    /**
     * Get slides
     *
     * @return string 
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * Set joindin
     *
     * @param integer $joindin
     */
    public function setJoindin($joindin)
    {
        $this->joindin = $joindin;
    }

    /**
     * Get joindin
     *
     * @return integer 
     */
    public function getJoindin()
    {
        return $this->joindin;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}