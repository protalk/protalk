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
     * @Route("/media/{id}", name="api_media_detail")
     * @Template()
     */
    public function getMediaDetailAction($id)
    {
        $resource = new Resource(new Link('/location', 'self'));

        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $media = $mediaRepository->findOneBySlug('clean-php', Query::HYDRATE_ARRAY);

        $mediaResource        = new Resource(new Link('/media/' . $media['id'], 'self'), 'media');
        $mediaResource->title = $media['title'];
        $resource->addResource($mediaResource);

        $view = View::create(array('media' => $resource->asArray()))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($resource->asArray());

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}