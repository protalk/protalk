<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use Doctrine\ORM\Query;
use JoshuaEstes\Hal\Link;
use JoshuaEstes\Hal\Resource;

/**
 * Class MediaController
 * @package Protalk\ApiBundle\Controller
 */
class MediaDetailController extends FOSRestController
{
    /**
     * @Route("/media/{slug}", name="api_media_detail")
     * @Template()
     */
    public function getMediaDetailAction($slug)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItem = $mediaRepository->findOneBySlug($slug, Query::HYDRATE_ARRAY);

        $formattedMediaItem = $this->container->get('protalk_api.helper.media_detail')->buildArray(new \RecursiveArrayIterator($mediaItem));

        $view = View::create(array('media' => $formattedMediaItem))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($formattedMediaItem);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}