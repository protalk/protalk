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

        $latestMedia = $repository->getMediaOrderedBy('date', 1, $numRows);
        $topViewedMedia = $repository->getMediaOrderedBy('visits', 1, $numRows);
        $topRatedMedia = $repository->getMediaOrderedBy('rating', 1, $numRows);

        return array('latestMedia' => $latestMedia['results'] , 'topViewedMedia' => $topViewedMedia['results'], 'topRatedMedia' => $topRatedMedia['results']);
    }
}
