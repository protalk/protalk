<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\TagRepository")
 */
class Tag
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
     * @ORM\OneToMany(targetEntity="Media_tag", mappedBy="tag")
     */
    protected $medias;

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
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add medias
     *
     * @param Protalk\MediaBundle\Entity\Media_tag $medias
     */
    public function addMedia_tag(\Protalk\MediaBundle\Entity\Media_tag $medias)
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