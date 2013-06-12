<?php

namespace Protalk\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use Doctrine\ORM\Query;

class SpeakerDetailController extends FOSRestController
{
    /**
     * @Route("/speaker/{id}", name="api_speaker_detail")
     * @Template()
     */
    public function getSpeakerDetailAction($id)
    {
        $speakerRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Speaker');
        $speakerItem = $speakerRepository->findOneById($id, Query::HYDRATE_ARRAY);

        $formattedSpeakerItem = $this->container->get('protalk_api.helper.speaker_detail')->buildArray(new \RecursiveArrayIterator($speakerItem));

        $view = View::create(array('speaker' => $formattedSpeakerItem))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('speaker')
            ->setData($formattedSpeakerItem);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}