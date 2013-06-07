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
class MediaListController extends FOSRestController
{
    /**
     * @Route("/media", name="api_media_list")
     * @Template()
     */
    public function getMediaListAction()
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->getMediaOrderedBy('id', 1, 5, 'DESC', Query::HYDRATE_ARRAY);

        $view = View::create(array('media' => $mediaItems['results']))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Media:getMediaList.html.twig')
            ->setTemplateVar('media')
            ->setData($mediaItems['results']);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}