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

/**
 * Protalk\MediaBundle\Entity\Language
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\LanguageRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
 *
 */
class Language implements SluggableInterface
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var string $slug
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="LanguageCategory", mappedBy="language", cascade={"persist"}, orphanRemoval=true)
     */
    private $languageCategories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->languageCategories = new ArrayCollection();
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

        $slugger = new Slugger('-', '-');

        $slug = $slugger->getSlug($this->getSlugFields());

        return $this->setSlug($slug);
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
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
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
     * Add languageCategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     * @return Language
     */
    public function addLanguageCategory(LanguageCategory $languageCategory)
    {
        $this->languageCategories[] = $languageCategory;
    
        return $this;
    }
    
    /**
     * Add languageCategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     * @return Language
     */
    public function addLanguageCategorie(LanguageCategory $languageCategory)
    {
        return $this->addLanguageCategory($languageCategory);
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
     * Remove languageCategory
     *
     * @param \Protalk\MediaBundle\Entity\LanguageCategory $languageCategory
     */
    public function removeLanguageCategorie(LanguageCategory $languageCategory)
    {
        $this->removeLanguageCategory($languageCategory);
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
    
    /**
     * Set language categories
     * 
     * @param \Protalk\MediaBundle\Entity\LanguageCategory[] $languageCategories 
     */
    public function setLanguageCategories($languageCategories)
    {
        $this->languageCategories = new ArrayCollection();

        foreach ($languageCategories as $category) {
            $this->addLanguageCategory($category);
        }
    }
    
    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}