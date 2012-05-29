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
    public function resultAction($search = -1, $sort = 'date', $page = 1)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $results = array();
        if (-1 == $search) {
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('ProtalkMediaBundle:Media');
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize);
        }
        
        return array('results' => $results, 'total' => count($results));
    }
    
    /**
     * @Route("/tag/{id}/{sort}/{page}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function tagAction($id, $sort = 'date', $page = 1)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByTag($id, $sort, $page, $pageSize);
        
        return array("results" => $results, 'total' => count($results));
    }
    
    /**
     * @Route("/category/{id}/{sort}/{page}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function categoryAction($id, $sort = 'date', $page = 1)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByCategory($id, $sort, $page, $pageSize);
        
        return array("results" => $results, 'total' => count($results));
    }
    
    /**
     * @Route("/search/speaker/{id}/{sort}/{page}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function speakerAction($id, $sort = 'date', $page = 1)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findBySpeaker($id, $sort, $page, $pageSize);
        
        return array("results" => $results, 'total' => count($results));
    }
}
