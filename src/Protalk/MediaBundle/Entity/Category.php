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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true, onDelete="set null")
     */
    private $parent_id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     * @Assert\Length(
     *    min = "2",
     *    max = "50",
     *    minMessage = "A category must be at least {{ limit }} character in length",
     *    maxMessage = "A category cannot be longer than {{ limit }} characters length"
     * )
     */
    private $name;

    /**
     * @var array $children
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent_id")
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="LanguageCategory", mappedBy="category")
     */
    private $languageCategories;

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
        $this->children = new ArrayCollection();
        $this->languageCategories = new ArrayCollection();
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
     * @param \Protalk\MediaBundle\Entity\Category $children
     *
     * @return void
     */
    public function addCategory(Category $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
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

    /**
     * Add children
     *
     * @param \Protalk\MediaBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Protalk\MediaBundle\Entity\Category $children
     */
    public function removeChildren(Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Add languageCategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     * @return Category
     */
    public function addLanguageCategory(LanguageCategory $languageCategory)
    {
        $this->languageCategories[] = $languageCategory;
        $languageCategory->setCategory($this);
    
        return $this;
    }

    /**
     * Remove languageCategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     */
    public function removeLanguageCategory(LanguageCategory $languageCategory)
    {
        $this->languageCategories->removeElement($languageCategory);
    }

    /**
     * Get languageCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguageCategories()
    {
        return $this->languageCategories;
    }
}