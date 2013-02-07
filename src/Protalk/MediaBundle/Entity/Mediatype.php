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
 * Protalk\MediaBundle\Entity\Mediatype
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\MediatypeRepository")
 */
class Mediatype
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="mediatype")
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity="Feed", mappedBy="mediatype")
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
        $this->medias = new ArrayCollection();
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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * Add medias
     *
     * @param Protalk\MediaBundle\Entity\Media $medias
     */
    public function addMedia(\Protalk\MediaBundle\Entity\Media $medias)
    {
        $this->medias[] = $medias;
    }

    /**
     * Get medias
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }
}
