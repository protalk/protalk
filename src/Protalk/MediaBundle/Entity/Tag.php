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

use SamJ\DoctrineSluggableBundle\Slugger;
use SamJ\DoctrineSluggableBundle\SluggableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Protalk\MediaBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\TagRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 */
class Tag implements SluggableInterface
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
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     * @Assert\Length(
     *    min = "2",
     *    max = "50",
     *    minMessage = "A tag must be at least {{ limit }} character in length",
     *    maxMessage = "A tag cannot be longer than {{ limit }} characters length"
     * )
     */
    private $name;

    /**
     * @var ArrayCollection $medias
     *
     * @ORM\OneToMany(targetEntity="MediaTag", mappedBy="tag")
     */
    private $medias;

    /**
     * @var string $slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        if(!$this->name) {
            return 'pending';
        }

        return $this->name;
    }

    /**
     * Add media
     *
     * @param Protalk\MediaBundle\Entity\MediaTag $medias
     */
    public function addMedia(\Protalk\MediaBundle\Entity\MediaTag $media)
    {
        $this->medias[] = $media;
        $media->setTag($this);

        return $this;
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
     * Set slug
     *
     * @param string $slug
     */

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Exists because the backend makes a call to getSlug()
     * when creating/updating tags.
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get slug fields
     *
     * @return string
     */
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
}
