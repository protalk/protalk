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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use SamJ\DoctrineSluggableBundle\SluggableInterface;
use SamJ\DoctrineSluggableBundle\Slugger;


/**
 * Protalk\MediaBundle\Entity\Speaker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\SpeakerRepository")
 * @UniqueEntity("name")
 */
class Speaker implements SluggableInterface
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
     * @var ArrayCollection $medias
     *
     * @ORM\OneToMany(targetEntity="MediaSpeaker", mappedBy="speaker")
     */
    private $medias;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string $photo
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var text $biography
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var string $slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
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
     * Set photo
     *
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set biography
     *
     * @param text $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * Get biography
     *
     * @return text
     */
    public function getBiography()
    {
        return $this->biography;
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

    /**
     * Get object as string (name)
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlugFields()
    {
        return $this->getName();
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
     * Remove medias
     *
     * @param \Protalk\MediaBundle\Entity\MediaSpeaker $medias
     */
    public function removeMedia(\Protalk\MediaBundle\Entity\MediaSpeaker $medias)
    {
        $this->medias->removeElement($medias);
    }
}