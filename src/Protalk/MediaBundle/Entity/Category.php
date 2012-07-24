<?php

namespace Protalk\MediaBundle\Entity;

use SamJ\DoctrineSluggableBundle\SluggableInterface;
use SamJ\DoctrineSluggableBundle\Slugger;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Protalk\MediaBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 *
 */
class Category implements SluggableInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var integer $parent_id
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent_id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var array $children
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent_id")
     */
    private $children;

    /**
     * @var ArrayCollection $medias
     *
     * @ORM\ManyToMany(targetEntity="Media", mappedBy="categories")
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
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set parent_id
     *
     * @param integer $parentId
     */
    public function setParentId($parentId)
    {
        $this->parent_id = $parentId;
    }

    /**
     * Get parent_id
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parent_id;
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
     * Get object as string (name)
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add children
     *
     * @param Protalk\MediaBundle\Entity\Category $children
     */
    public function addCategory(\Protalk\MediaBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
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
        return $this->getName();
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