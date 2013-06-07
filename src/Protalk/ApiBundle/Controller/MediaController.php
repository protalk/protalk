<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;

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
    public function getMediaAction($id)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->findAll();

        $view = $this->view($mediaItems, 200);
        $view->setTemplate('ProtalkApiBundle:Media:getMedia.html.twig');
        $view->setTemplateVar('media');

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}