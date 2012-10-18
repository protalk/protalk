<?php

namespace Protalk\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protalk\MediaBundle\Entity\Feed
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Protalk\MediaBundle\Entity\FeedRepository")
 */
class Feed
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer $feedtype_id
     *
     * @ORM\Column(name="feedtype_id", type="integer")
     */
    private $feedtype_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Feedtype", inversedBy="feeds")
     * @ORM\JoinColumn(name="feedtype_id", referencedColumnName="id")
     */
    protected $feedtype;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=200)
     */
    private $url;

    /**
     * @var boolean $automaticImport
     *
     * @ORM\Column(name="automaticImport", type="boolean", nullable="true")
     */
    private $automaticImport;

    /**
     * @var string $contact
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable="true")
     */
    private $contact;

    /**
     * @var string $confirmation
     *
     * @ORM\Column(name="confirmation", type="string", length=20)
     */
    private $confirmation;

    /**
     * @var text $remark
     *
     * @ORM\Column(name="remark", type="text", nullable="true")
     */
    private $remark;


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
     * Set feedtype_id
     *
     * @param integer $feedtypeId
     */
    public function setFeedtypeId($feedtypeId)
    {
        $this->feedtype_id = $feedtypeId;
    }

    /**
     * Get feedtype_id
     *
     * @return integer 
     */
    public function getFeedtypeId()
    {
        return $this->feedtype_id;
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
     * Set automaticImport
     *
     * @param boolean $automaticImport
     */
    public function setAutomaticImport($automaticImport)
    {
        $this->automaticImport = $automaticImport;
    }

    /**
     * Get automaticImport
     *
     * @return boolean 
     */
    public function getAutomaticImport()
    {
        return $this->automaticImport;
    }

    /**
     * Set contact
     *
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set confirmation
     *
     * @param string $confirmation
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
    }

    /**
     * Get confirmation
     *
     * @return string 
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Set remark
     *
     * @param text $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * Get remark
     *
     * @return text 
     */
    public function getRemark()
    {
        return $this->remark;
    }
    
    /**
     * Set feedtype
     *
     * @param Protalk\MediaBundle\Entity\Feedtype $feedtype
     */
    public function setFeedtype(\Protalk\MediaBundle\Entity\Feedtype $feedtype)
    {
        $this->feedtype = $feedtype;
    }

    /**
     * Get feedtype
     *
     * @return Protalk\MediaBundle\Entity\Feedtype
     */
    public function getFeedtype()
    {
        return $this->feedtype;
    }
}