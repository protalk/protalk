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
        $count = $this->container->get('request')->get('count') ?: 10;

        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Speaker');
        $speakerItems = $mediaRepository->getSpeakers($count);


        $view = View::create(array('speaker' => $speakerItems))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('speaker')
            ->setData($speakerItems);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}