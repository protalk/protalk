<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Protalk\MediaBundle\Entity\Speaker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\SpeakerRepository")
 */
class Speaker
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
     * @ORM\ManyToMany(targetEntity="Media")
     * @ORM\JoinTable(name="Media_speaker",
     *      joinColumns={@ORM\JoinColumn(name="speaker_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")}
     * )
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
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var text $biography
     *
     * @ORM\Column(name="biography", type="text")
     */
    private $biography;

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
     * Add medias
     *
     * @param Protalk\MediaBundle\Entity\Media_Speaker $medias
     */
    public function addMedia_Speaker(\Protalk\MediaBundle\Entity\Media_Speaker $medias)
    {
        $this->medias[] = $medias;
    }
}