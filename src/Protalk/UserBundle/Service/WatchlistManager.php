<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\UserBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Protalk\MediaBundle\Entity\Media;

/**
 * Watchlist Manager service class
 *
 * This class manages items on user's watchlist
 *
 * @author Kim Rowan
 */
class WatchlistManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    protected $securityContext;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    protected $session;

    public function __construct(EntityManager $entityManager, SecurityContext $securityContext, Session $session)
    {
        $this->entityManager = $entityManager;
        $this->securityContext = $securityContext;
        $this->session = $session;
    }

    /**
     * Add media item to user's watchlist
     *
     * @param Media $media
     */
    public function addItem(Media $media)
    {
        $user = $this->securityContext->getToken()->getUser();

        if($user->getWatchlist()->contains($media)){
            $this->session->getFlashBag()->add(
                'watchlist_notice',
                'you already have it!'
            );

            return;
        }

        $user->addWatchlist($media);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->session->getFlashBag()->add(
            'watchlist_notice',
            'successfully added!'
        );

        return;
    }

    /**
     * Remove media item from user's watchlist
     *
     * @param Media $media
     */
    public function removeItem(Media $media)
    {
        $user = $this->securityContext->getToken()->getUser();

        if( ! $user->getWatchlist()->contains($media)){
            $this->session->getFlashBag()->add(
                'watchlist_notice',
                "you didn't have it!"
            );

            return;
        }

        $user->removeWatchlist($media);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->session->getFlashBag()->add(
            'watchlist_notice',
            'successfully removed!'
        );

        return;
    }
}
