<?php

namespace Protalk\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\PageBundle\Entity\Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\PageBundle\Entity\PageRepository")
 */
class Page
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
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=100, unique=true)
     */
    private $url;

    /**
     * @var string $pageTitle
     *
     * @ORM\Column(name="pagetitle", type="string", length=100)
     */
    private $pageTitle;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


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
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set pagetitle
     *
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get pagetitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
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

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }
}