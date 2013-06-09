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
        $speakerItems = $this->fetchSpeakerItems();
        $formattedSpeakerItems = $this->container->get('protalk_api.helper.speaker_list')->buildArray($speakerItems);

        $view = View::create(array('speaker' => $formattedSpeakerItems))
            ->setStatusCode(200)
            ->setEngine('twig')
            ->setTemplate('ProtalkApiBundle:Error:noHtml.html.twig')
            ->setTemplateVar('speaker')
            ->setData($formattedSpeakerItems);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Fetch the speaker items from the repository
     *
     * @return \RecursiveIteratorIterator
     */
    protected function fetchSpeakerItems()
    {
        $countSpeakerItems = $this->container->get('request')->get('count') ?: 10;

        $speakerRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Speaker');
        $speakerItems = $speakerRepository->getSpeakers($countSpeakerItems, Query::HYDRATE_ARRAY);

        return new \RecursiveArrayIterator($speakerItems);
    }
}