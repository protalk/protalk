<?php

namespace Protalk\MediaBundle\Entity;

use SamJ\DoctrineSluggableBundle\SluggableInterface;
use SamJ\DoctrineSluggableBundle\Slugger;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Protalk\MediaBundle\Entity\Media
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Media implements SluggableInterface
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
     * @var ArrayCollection $speakers
     *
     * @ORM\ManyToMany(targetEntity="Speaker", inversedBy="medias")
     * @ORM\JoinTable(name="Media_speaker",
     *     joinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="speaker_id", referencedColumnName="id")}
     * )
     */
    private $speakers;

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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=200)
     */
    private $title;

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
     * @ORM\Column(type="string")
     */
    protected $slug;

    /*
     * Constructor
     *
     * Initialize all collection fields to empty ArrayCollections
     * in order to support the relationship before object persisted
     * to database (when it would otherwise be null)
     *
     */
    public function __construct()
    {
        $this->speakers = new ArrayCollection();
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

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get shorter version of media title
     *
     * @param  Maximum allowed length of media title
     * @return string
     */
    public function getTruncatedTitle($length = 25)
    {
        if (strlen($this->title) > $length )
        {
           return substr($this->title, 0, $length) . '...';
        }

        return $this->title;
    }

    /*
     * Get slug
     *
     * @return string
     */

    public function getSlug()
    {
        return $this->slug;
    }

    /*
     * Set slug
     *
     * @param string $slug
     */

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /*
     * Get slug fields
     *
     * @return string
     */

    public function getSlugFields() {
        return $this->getTitle();
    }


    /**
     * Add speakers
     *
     * @param Protalk\MediaBundle\Entity\Speaker $speakers
     */
    public function addSpeaker(\Protalk\MediaBundle\Entity\Speaker $speakers)
    {
        $this->speakers[] = $speakers;
    }

    /**
     * Get speakers
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * Add speakers
     *
     * @param Protalk\MediaBundle\Entity\Media_Speaker $speakers
     */
    public function addMedia_Speaker(\Protalk\MediaBundle\Entity\Media_Speaker $speakers)
    {
        $this->speakers[] = $speakers;
    }

    /**
     * Get one speaker's truncated name
     *
     * @param  integer Maximum allowed length of speaker name
     * @return string
     */
    public function getTruncatedSpeaker($length = 10)
    {
        $speaker = $this->getOneSpeaker();

        if (strlen($speaker) > $length )
        {
           return substr($speaker, 0, $length) . '...';
        }

        return $speaker;
    }

    /**
     * Get one speaker's name
     *
     * @return string
     */
    public function getOneSpeaker()
    {
        return ($this->speakers->count() > 1) ? $this->speakers[0].' et al' : $this->speakers[0] ;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateSlug()
    {

        $slugger = new Slugger();

        $slug = $slugger->getSlug($this->getSlugFields());

        return $this->setSlug($slug);
    }
}