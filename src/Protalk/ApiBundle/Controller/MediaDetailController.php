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
class MediaDetailController extends FOSRestController
{
    /**
     * @Route("/media/{id}", name="api_media_detail")
     * @Template()
     */
    public function getMediaDetailAction($id)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $media = $mediaRepository->findOneBySlug('clean-php', Query::HYDRATE_ARRAY);

        $view = View::create(array('media' => $media))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($media);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}