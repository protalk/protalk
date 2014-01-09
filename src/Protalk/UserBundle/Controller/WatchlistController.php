<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Protalk\MediaBundle\Entity\Media;

class WatchlistController extends Controller
{
    /**
     * Add action
     *
     * Adds an item to the logged-in user's watch list
     *
     * @Route("/watchlist/add/{media_slug}", name="watchlist_add")
     * @ParamConverter("media", options={"mapping": {"media_slug": "slug"}})
     */
    public function addAction(Media $media)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $securityContext = $this->get('security.context');
        $request = $this->getRequest();
        $referer = $request->request->get('referer', $request->headers->get('referer'));

        if( !$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            return new RedirectResponse($referer);
        }

        if($user->getWatchlist()->contains($media)){
            $this->get('session')->getFlashBag()->add(
                'watchlist_notice',
                'you already have it!'
            );
            return new RedirectResponse($referer);
        }

        $user->addWatchlist($media);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->get('session')->getFlashBag()->add(
            'watchlist_notice',
            'successfully added!'
        );

        return new RedirectResponse($referer);
    }

    /**
     * Remove action
     *
     * Removes an item from the logged-in user's watch list
     *
     * @Route("/watchlist/remove/{media_slug}", name="watchlist_remove")
     * @ParamConverter("media", options={"mapping": {"media_slug": "slug"}})
     */
    public function removeAction(Media $media)
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $securityContext = $this->get('security.context');
        $request = $this->getRequest();
        $referer = $request->request->get('referer', $request->headers->get('referer'));

        if( !$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            return new RedirectResponse($referer);
        }

        if(!$user->getWatchlist()->contains($media)){
            $this->get('session')->getFlashBag()->add(
                'watchlist_notice',
                "you didn't have it!"
            );
            return new RedirectResponse($referer);
        }

        $user->removeWatchlist($media);

        $this->get('session')->getFlashBag()->add(
            'watchlist_notice',
            'successfully removed!'
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new RedirectResponse($referer);
    }
}