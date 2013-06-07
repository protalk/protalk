<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class MediaController
 * @package Protalk\ApiBundle\Controller
 */
class MediaController extends FOSRestController
{
    /**
     * @Route("/media/{id}", name="api_media_show")
     * @Template()
     */
    public function getMediaAction()
    {
        return $this->render('ProtalkApiBundle:Media:getMedia.html.twig', array('media' => 'test'));
    }
}