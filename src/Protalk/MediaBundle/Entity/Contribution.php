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
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * Protalk\MediaBundle\Entity\Media
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\ContributionRepository")
 */
class Contribution
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
     * @var text $category
     *
     * @ORM\Column(name="category", type="string", length=30)
     * @Assert\NotBlank(
     *      message = "Please select a category from the list:"
     * )
     */
    private $category;

    /**
     * @var text $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank(
     *      message = "Please enter your name:"
     * )
     */
    private $name;

    /**
     * @var text $email
     *
     * @ORM\Column(name="email", type="string", length=50)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email:",
     *     checkMX = true
     * )
     * @Assert\NotBlank(
     *      message = "Please enter your email address:"
     * )
     */
    private $email;

    /**
     * @var string $hostUrl
     *
     * @ORM\Column(name="hostUrl", type="string", length=100)
     * @Assert\Url(
     *  message = "The url '{{ value }}' is not a valid url:"
     * )
     * @Assert\NotBlank(
     *      message = "Please enter the URL where the media is hosted:"
     * )
     */
    private $hostUrl;

    /**
     * @var text $hostName
     *
     * @ORM\Column(name="hostName", type="string", length=100)
     * @Assert\NotBlank(
     *      message = "Please enter the name of the site where the media is hosted:"
     * )
     */
    private $hostName;

    /**
     * @var text $title
     *      *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(
     *      message = "Please enter the media item's title:"
     * )
     */
    private $title;

    /**
     * @var float $slidesUrl
     *
     * @ORM\Column(name="slidesUrl", type="string", length=200, nullable=true)
     */
    private $slidesUrl;

    /**
     * @var integer $speaker
     *
     * @ORM\Column(name="speaker", type="string", length=100)
     * @Assert\NotBlank(
     *      message = "Please enter the speaker's name:"
     * )
     */
    private $speaker;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(
     *      message = "Please enter a brief description of the media:"
     * )
     */
    private $description;

    /**
     * @var string $tags
     *
     * @ORM\Column(name="tags", type="string", length=100, nullable=true)
     */
    private $tags;

    /**
     * @Recaptcha\True
     */
    public $recaptcha;

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
     * Set category_id
     *
     * @param integer $categoryId
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get category_id
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set hostUrl
     *
     * @param string $hostUrl
     */
    public function setHostUrl($hostUrl)
    {
        $this->hostUrl = $hostUrl;
    }

    /**
     * Get hostUrl
     *
     * @return string
     */
    public function getHostUrl()
    {
        return $this->hostUrl;
    }

    /**
     * Set hostName
     *
     * @param string $hostName
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * Get hostName
     *
     * @return string
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * Set slidesUrl
     *
     * @param string $slidesUrl
     */
    public function setSlidesUrl($slidesUrl)
    {
        $this->slidesUrl = $slidesUrl;
    }

    /**
     * Get slidesUrl
     *
     * @return string
     */
    public function getSlidesUrl()
    {
        return $this->slidesUrl;
    }

    /**
     * Set speaker
     *
     * @param string $speaker
     */
    public function setSpeaker($speaker)
    {
        $this->speaker = $speaker;
    }

    /**
     * Get speaker
     *
     * @return string
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
