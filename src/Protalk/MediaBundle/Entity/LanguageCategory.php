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
 * Protalk\MediaBundle\Entity\LanguageCategory
 *
 * @ORM\Table(name="languageCategory")
 * @ORM\Entity()
 *
 */
class LanguageCategory
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
     * @var integer $language_id
     *
     * @ORM\Column(name="language_id", type="integer")
     */
    private $language_id;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    protected $language;

    /**
     * @var integer $category_id
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $category_id;
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var ArrayCollection $medias
     *
     * @ORM\ManyToMany(targetEntity="Media", mappedBy="languageCategories")
     */
    private $medias;
    /**
     * Constructor function
     *
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

}