<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;

/**
 * Class MediaController
 * @package Protalk\ApiBundle\Controller
 */
class MediaListController extends FOSRestController
{
    /**
     * @Route("/media", name="api_media_list")
     * @Template()
     */
    public function getMediaListAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT media FROM ProtalkMediaBundle:Media media');

        $mediaItems = $query->getArrayResult();

        $view = View::create(array('media' => $mediaItems))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Media:getMediaList.html.twig')
            ->setTemplateVar('media')
            ->setData($mediaItems);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}