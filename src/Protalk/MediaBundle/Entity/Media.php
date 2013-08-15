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

use SamJ\DoctrineSluggableBundle\SluggableInterface;
use SamJ\DoctrineSluggableBundle\Slugger;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Protalk\MediaBundle\Entity\Media
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Media implements SluggableInterface
{
    const STATUS_PENDING = 'pend';
    const STATUS_PUBLISHED = 'pub';
    const STATUS_UNPUBLISHED = 'unpub';
    const STATUS_REJECTED = 'rej';

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
     * @ORM\ManyToOne(targetEntity="Mediatype", inversedBy="medias")
     * @ORM\JoinColumn(name="mediatype_id", referencedColumnName="id")
     */
    protected $mediatype;

    /**
     * @var ArrayCollection $speakers
     *
     * @ORM\OneToMany(targetEntity="MediaSpeaker", mappedBy="media", cascade={"persist"}, orphanRemoval=true)
     */
    private $speakers;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="media")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="media")
     */
    private $ratings;

    /**
     * @var ArrayCollection $tags
     *
     * @ORM\OneToMany(targetEntity="MediaTag", mappedBy="media", cascade={"persist"}, orphanRemoval=true)
     */
    private $tags;

    /**
     * @var ArrayCollection $languageCategories
     *
     * @ORM\OneToMany(targetEntity="MediaLanguageCategory", mappedBy="media", cascade={"persist"}, orphanRemoval=true)
     */
    private $languageCategories;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
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
     * @Assert\Length(
     *    min = "2",
     *    max = "200",
     *    minMessage = "A media title must be at least {{ limit }} character in length",
     *    maxMessage = "A media title cannot be longer than {{ limit }} characters length"
     * )
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
     * @var string $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string $slides
     *
     * @ORM\Column(name="slides", type="text", nullable=true)
     */
    private $slides;

    /**
     * @var integer $joindin
     *
     * @ORM\Column(name="joindin", type="integer", nullable=true)
     */
    private $joindin;

    /**
     * @var string $language
     *
     * @ORM\Column(name="language", type="string", length=2)
     */
    private $language;

    /**
     * @var string $slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status;

    /**
     * @var boolean $isImported
     *
     * @ORM\Column(name="isImported", type="boolean")
     */
    private $isImported;

    /**
     * @var string $hostName
     *
     * @ORM\Column(name="hostName", type="string")
     */
    private $hostName;

    /**
     * @var string $hostUrl
     *
     * @ORM\Column(name="hostUrl", type="string")
     */
    private $hostUrl;

    /**
     * @var string $thumbnail
     *
     * @ORM\Column(name="thumbnail", type="string", length=250, nullable=true)
     */
    private $thumbnail;

    /**
     * @var \DateTime $creationDate
     *
     * @ORM\Column(name="creationDate", type="date")
     */
    private $creationDate;

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
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->languageCategories = new ArrayCollection();
        $this->creationDate = new \DateTime();

        $this->isImported = false;
        $this->rating = 0;
        $this->visits = 0;

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
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
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
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return string
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

    public function getSlugFields()
    {
        return $this->getTitle();
    }

    /**
     * Add speakers
     *
     * @param \Protalk\MediaBundle\Entity\MediaSpeaker $speakers
     */
    public function addSpeaker(\Protalk\MediaBundle\Entity\MediaSpeaker $speakers)
    {
        $this->speakers[] = $speakers;
    }

    /**
     * Get speakers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * Set speakers
     *
     * @param \Doctrine\Common\Collections\Collection $speakers
     */
    public function setSpeakers($speakers)
    {
        $this->speakers = $speakers;
    }

    /**
     * Get one speaker's truncated name
     *
     * @param integer $length Maximum allowed length of speaker name
     * @return string
     */
    public function getTruncatedSpeaker($length = 16)
    {
        $speaker = $this->getOneSpeaker();

        if (strlen($speaker) > $length ){
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
        $slugger = new Slugger('-', '-');

        $slug = $slugger->getSlug($this->getSlugFields());

        return $this->setSlug($slug);
    }

    /**
     * Set hostName
     *
     * @param string $hostName
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * Get hostName
     *
     * @return string
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * Set hostUrl
     *
     * @param string $hostUrl
     */
    public function setHostUrl($hostUrl)
    {
        $this->hostUrl = $hostUrl;
    }

    /**
     * Get hostUrl
     *
     * @return string
     */
    public function getHostUrl()
    {
        return $this->hostUrl;
    }

    /**
     * Set mediatype
     *
     * @param \Protalk\MediaBundle\Entity\Mediatype $mediatype
     */
    public function setMediatype(\Protalk\MediaBundle\Entity\Mediatype $mediatype)
    {
        $this->mediatype = $mediatype;
    }

    /**
     * Get mediatype
     *
     * @return \Protalk\MediaBundle\Entity\Mediatype
     */
    public function getMediatype()
    {
        return $this->mediatype;
    }

    /**
     * Add comments
     *
     * @param \Protalk\MediaBundle\Entity\Comment $comments
     */
    public function addComment(\Protalk\MediaBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguageCategory()
    {
        return $this->languageCategories;
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguageCategories()
    {
        return $this->languageCategories;
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param \Doctrine\Common\Collections\Collection $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    
    /**
     * Set language category
     *
     * @param \Doctrine\Common\Collections\Collection $categories
     */
    public function setLanguageCategory($categories)
    {
        $this->languageCategories = $categories;
    }

    /**
     * Convert object to string
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Add language category
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategory
     */
    public function addLanguageCategory(MediaLanguageCategory $languageCategory)
    {
        $this->languageCategories[] = $languageCategory;
    }

    /**
     * Remove language category
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategory
     */
    public function removeLanguageCategory(MediaLanguageCategory $languageCategory)
    {
        $this->languageCategories->removeElement($languageCategory);
    }

    /**
     * Add tags
     *
     * @param \Protalk\MediaBundle\Entity\MediaTag $tags
     */
    public function addTag(MediaTag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * Get thumbnail
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set creationDate
     *
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Get creationDate
     *
     * @return string
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Display thumbnail
     *
     * @return string thumnail filename
     */
    public function displayThumbnail()
    {
        if (strpos($this->getMediatype()->getType(), 'podcast') !== false) {
            return "/images/thumbnails/podcast_icon.png";
        } elseif (!$this->thumbnail) {
            return "/images/thumbnails/video_icon.png";
        } else {
            return $this->thumbnail;
        }
    }

    /**
     * Add ratings
     *
     * @param \Protalk\MediaBundle\Entity\Rating $ratings
     */
    public function addRating(Rating $ratings)
    {
        $this->ratings[] = $ratings;
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Check whether value in slides field
     * is a URL
     *
     * @return boolean
     */
    public function slidesIsLink()
    {
        $boolean = (substr($this->slides, 0, 4) == "http") ? true : false;

        return $boolean;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Media
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set isImported
     *
     * @param boolean $isImported
     * @return Media
     */
    public function setIsImported($isImported)
    {
        $this->isImported = $isImported;
    
        return $this;
    }

    /**
     * Get isImported
     *
     * @return boolean 
     */
    public function getIsImported()
    {
        return $this->isImported;
    }

    /**
     * Remove speakers
     *
     * @param \Protalk\MediaBundle\Entity\MediaSpeaker $speakers
     */
    public function removeSpeaker(MediaSpeaker $speakers)
    {
        $this->speakers->removeElement($speakers);
    }
    
    /**
     * Remove comments
     *
     * @param \Protalk\MediaBundle\Entity\Comment $comments
     */
    public function removeComment(Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Remove ratings
     *
     * @param \Protalk\MediaBundle\Entity\Rating $ratings
     */
    public function removeRating(Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Remove tags
     *
     * @param \Protalk\MediaBundle\Entity\MediaTag $tags
     */
    public function removeTag(MediaTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Add languageCategories
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategories
     * @return Media
     */
    public function addLanguageCategorie(\Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategories)
    {
        $this->languageCategories[] = $languageCategories;
    
        return $this;
    }

    /**
     * Remove languageCategories
     *
     * @param \Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategories
     */
    public function removeLanguageCategorie(\Protalk\MediaBundle\Entity\MediaLanguageCategory $languageCategories)
    {
        $this->languageCategories->removeElement($languageCategories);
    }
}