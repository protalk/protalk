<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use Doctrine\ORM\Query;


/**
 * Class MediaController
 * @package Protalk\ApiBundle\Controller
 */
class MediaController extends FOSRestController
{
    /**
     * @Route("/media", name="api_media_list")
     * @Template()
     */
    public function getMediaListAction()
    {
        $mediaItems = $this->fetchMediaItems();
        $formattedMediaItems = $this->container->get('protalk_api.helper.media_list')->buildArray($mediaItems);

        $view = View::create(array('media' => $formattedMediaItems))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($formattedMediaItems);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Fetch the media items from the repository
     *
     * @return \RecursiveIteratorIterator
     */
    protected function fetchMediaItems()
    {
        $countMediaItems = $this->container->get('request')->get('count') ?: 10;
        $pageMediaItems = $this->container->get('request')->get('page') ?: 1;
        $sortMediaItems = $this->container->get('request')->get('sort') ?: 'DESC';

        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->getMediaOrderedBy('id', $pageMediaItems, $countMediaItems, $sortMediaItems, Query::HYDRATE_ARRAY);

        return new \RecursiveArrayIterator($mediaItems['results']);
    }
}