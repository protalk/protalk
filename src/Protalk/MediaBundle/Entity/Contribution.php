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
     * @var text $title
     *      *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(
     *      message = "Please enter the media item's title:"
     * )
     */
    private $title;

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
