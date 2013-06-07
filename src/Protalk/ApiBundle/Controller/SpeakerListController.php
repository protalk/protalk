<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;

class SpeakerListController extends FOSRestController
{
    /**
     * @Route("/speaker", name="api_speaker_list")
     * @Template()
     */
    public function getSpeakerListAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT speaker FROM ProtalkMediaBundle:Speaker speaker');

        $speakerItems = $query->getArrayResult();

        $view = View::create(array('speaker' => $speakerItems))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Speaker:getSpeakerList.html.twig')
            ->setTemplateVar('speaker')
            ->setData($speakerItems);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}