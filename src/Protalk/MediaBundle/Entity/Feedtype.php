<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Protalk\MediaBundle\Entity\Feedtype
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\FeedtypeRepository")
 */
class Feedtype
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string $className
     *
     * @ORM\Column(name="className", type="string", length=30)
     */
    private $className;

    /**
     * @ORM\OneToMany(targetEntity="Feed", mappedBy="feedtype")
     */
    private $feeds;

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
        $this->feeds = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set className
     *
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * Get className
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Convert this entity to a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add feeds
     *
     * @param Protalk\MediaBundle\Entity\Feed $feeds
     */
    public function addMedia(\Protalk\MediaBundle\Entity\Feed $feeds)
    {
        $this->feeds[] = $feeds;
    }

    /**
     * Get feeds
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * Add feeds
     *
     * @param \Protalk\MediaBundle\Entity\Feed $feeds
     * @return Feedtype
     */
    public function addFeed(\Protalk\MediaBundle\Entity\Feed $feeds)
    {
        $this->feeds[] = $feeds;
    
        return $this;
    }

    /**
     * Remove feeds
     *
     * @param \Protalk\MediaBundle\Entity\Feed $feeds
     */
    public function removeFeed(\Protalk\MediaBundle\Entity\Feed $feeds)
    {
        $this->feeds->removeElement($feeds);
    }
}