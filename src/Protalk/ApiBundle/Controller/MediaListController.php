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
class MediaListController extends FOSRestController
{
    /**
     * @Route("/media", name="api_media_list")
     * @Template()
     */
    public function getMediaListAction()
    {
        $resource = new Resource(new Link('/location', 'self'));

        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->getMediaOrderedBy('id', 1, 5, 'DESC', Query::HYDRATE_ARRAY);

        foreach($mediaItems['results'] as $item)
        {
            $mediaResource        = new Resource(new Link('/media/' . $item['id'], 'self'), 'media');
            $mediaResource->title = 'bla';
            $resource->addResource($mediaResource);
        }

        // You can add more links too
        $resource->addLink(new Link('/location/next', 'next'));
        $resource->addLink(new Link('/location/previous', 'previous'));

        $view = View::create(array('media' => $resource->asArray()))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($resource->asArray());

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}