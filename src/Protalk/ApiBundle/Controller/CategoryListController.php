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
class CategoryListController extends FOSRestController
{
    /**
     * @Route("/category", name="api_category_list")
     * @Template()
     */
    public function getCategoryListAction()
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->findByCategory('php', 'id', 1, 5, 'DESC', Query::HYDRATE_ARRAY);

        $view = View::create(array('media' => $mediaItems['results']))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('media')
            ->setData($mediaItems['results']);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}