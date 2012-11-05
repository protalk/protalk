<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{

    /**
     * @Route("/home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');

        $numRows = $this->container->getParameter('home_lists_max');

        $latestMedia = $repository->getMediaOrderedBy('date', 1, $numRows);
        $topViewedMedia = $repository->getMediaOrderedBy('visits', 1, $numRows + 2);
        $topRatedMedia = $repository->getMediaOrderedBy('rating', 1, $numRows + 2);

        return array(
            'latestMedia' => $latestMedia['results'],
            'topViewedMedia' => $topViewedMedia['results'],
            'topRatedMedia' => $topRatedMedia['results']
        );
    }

    /**
    * @Route("/feed")
    * @Template()
    */
    public function rssAction()
    {
        $em = $this->get('doctrine');

        $items = $em->getRepository('ProtalkMediaBundle:Media')->getMediaOrderedBy('creationDate', 1, 20);

        $templateItems = array();
        foreach ($items['results'] as $item) {
            $templateItems[] = $item;
        }
        //var_dump($templateItems[0]->title); die();
        return array('items' => $templateItems, 'date' => date('c'));
    }
}
