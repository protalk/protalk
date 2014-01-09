<?php
/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Protalk\UserBundle\Entity\User
 *
 * @author Kim Rowan
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Protalk\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Protalk\MediaBundle\Entity\Media")
     * @ORM\JoinTable(name="user_media",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")}
     *      )
     **/
    private $watchlist;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->watchlist = new ArrayCollection();

    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add watchlist
     *
     * @param \Protalk\MediaBundle\Entity\Media $watchlist
     * @return User
     */
    public function addWatchlist(\Protalk\MediaBundle\Entity\Media $watchlist)
    {
        $this->watchlist[] = $watchlist;
    
        return $this;
    }

    /**
     * Remove watchlist
     *
     * @param \Protalk\MediaBundle\Entity\Media $watchlist
     */
    public function removeWatchlist(\Protalk\MediaBundle\Entity\Media $watchlist)
    {
        $this->watchlist->removeElement($watchlist);
    }

    /**
     * Get watchlist
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWatchlist()
    {
        return $this->watchlist;
    }
}
