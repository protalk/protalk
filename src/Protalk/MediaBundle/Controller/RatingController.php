<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RatingController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction($rating)
    {
        //initialise partialStar variable to false
        $partialStar = 0;

        //round rating down nearest whole number
        $fullStars = floor($rating);

        //determine whether a partial star is required
        if ($rating - $fullStars > 0) {
            $partialStar = 1;
        }

        //calculate number of empty stars required to display
        $emptyStars = 5 - $fullStars - $partialStar;

        $result = array("fullStars"   => $fullStars,
                     "emptyStars"  => $emptyStars,
                     "partialStar" => $partialStar,
                     "rating"      => $rating);

        if ($this->getRequest()->isXmlHttpRequest()) {
            return $this->render('ProtalkMediaBundle:Rating:index.html.twig', $result);
        }

        return $result;
    }
}
