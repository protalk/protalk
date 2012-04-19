<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;

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

        $latestMedia = $repository->getMediaOrderedBy('date', $numRows);
        $topViewedMedia = $repository->getMediaOrderedBy('visits', $numRows);
        $topRatedMedia = $repository->getMediaOrderedBy('rating', $numRows);

        return array('latestMedia' => $latestMedia , 'topViewedMedia' => $topViewedMedia, 'topRatedMedia' => $topRatedMedia);
    }
}
