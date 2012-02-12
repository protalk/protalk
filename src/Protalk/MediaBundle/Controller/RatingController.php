<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RatingController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        //generate a random whole or decimal number between 0 and 5
        //retain original value for display purposes
        $rating = rand(0,50) / 10;

        //initialise partialStar variable to false
        $partialStar = 0;

        //round rating down nearest whole number
        $fullStars = floor($rating);

        //determine whether a partial star is required
        if ($rating - $fullStars > 0) $partialStar = 1;

        //calculate number of empty stars required to display
        $emptyStars = 5 - $fullStars - $partialStar;

        return array("fullStars"   => $fullStars,
                     "emptyStars"  => $emptyStars,
                     "partialStar" => $partialStar,
                     "rating"      => $rating);
    }
}
