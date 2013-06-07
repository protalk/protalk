<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use Doctrine\ORM\Query;

class SpeakerListController extends FOSRestController
{
    /**
     * @Route("/speaker", name="api_speaker_list")
     * @Template()
     */
    public function getSpeakerListAction()
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $mediaItems = $mediaRepository->findBySpeaker(9, 'id', 1, 5, Query::HYDRATE_ARRAY);


        $view = View::create(array('speaker' => $mediaItems['results']))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('speaker')
            ->setData($mediaItems['results']);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}