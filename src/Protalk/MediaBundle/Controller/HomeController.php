<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;

class HomeController extends Controller {

    /**
     * @Route("/home")
     * @Template()
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');

        $numRows = $this->container->getParameter('home_lists_max');

        $latestMedia = $repository->getMediaOrderedBy('date', $numRows);
        $topViewedMedia = $repository->getMediaOrderedBy('visits', $numRows);
        $topRatedMedia = $repository->getMediaOrderedBy('rating', $numRows);

        return array('latestMedia' => $latestMedia , 'topViewedMedia' => $topViewedMedia, 'topRatedMedia' => $topRatedMedia);
    }

   /* public function getMediaItems($listType) {
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                        'SELECT m FROM ProtalkMediaBundle:Media m ORDER BY m.date DESC'
                )->setMaxResults($this->container->getParameter('home_lists_max'));

        $repository = $this->getDoctrine()
                ->getRepository('ProtalkMediaBundle:Media');

        $query = $repository->createQueryBuilder('m');

        switch ($listType) {
            case 'latest':
            default:
                //TODO: Creation Date field (or similar) to be added to db
                //$query->orderBy('p.createdDate', 'DESC');
                break;
            case 'viewed':
                $query->orderBy('p.visits', 'DESC');
                break;
            case 'rated':
                $query->orderBy('p.rating', 'DESC');
                break;
        }

        $query->setMaxResults($this->container->getParameter('home_lists_max'))
              ->getQuery();


        try {
            $mediaItems = $query->getResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $mediaItems = null;
        }

        return $mediaItems;
    }
    *
    *
    */

}
