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
        $watchlistManager = $this->get('protalk.watchlist_manager');
        $watchlistManager->addItem($media);

        $request = $this->getRequest();
        $referer = $request->request->get('referer', $request->headers->get('referer'));

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
        $watchlistManager = $this->get('protalk.watchlist_manager');
        $watchlistManager->removeItem($media);

        $request = $this->getRequest();
        $referer = $request->request->get('referer', $request->headers->get('referer'));

        return new RedirectResponse($referer);
    }
}