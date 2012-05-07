<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\CategoryRepository")
 */
class Category
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
     * @var integer $parent_id
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parent_id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;


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
}