<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExploreController extends Controller
{    
    /**
     * @Route("/explore")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/result/{search}/{sort}/{page}")
     * @Template()
     */
    public function resultAction($search, $sort, $page)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $results = array();
        if (-1 == $search) {
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('ProtalkMediaBundle:Media');
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize);
        }
        
        return array('results' => $results);
    }
    
    /**
     * @Route("/tag/{id}")
     * @Template("ProtalkMediaBundle:Explore:result")
     */
    public function tagAction($id)
    {
        return array("results" => $results);
    }
    
    /**
     * @Route("/category/{id}")
     * @Template("ProtalkMediaBundle:Explore:result")
     */
    public function categoryAction($id)
    {
        return array("results" => $results);
    }
    
    /**
     * @Route("/search/speaker/{id}")
     * @Template("ProtalkMediaBundle:Explore:result")
     */
    public function speakerAction($id)
    {
        return array("results" => $results);
    }
}
