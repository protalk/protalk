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
        
        if ($this->getRequest()->getMethod() == 'POST') {
            $search = $this->getRequest()->get('search');
        }
        
        $results = array();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        
        if (-1 == $search) {    
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize);
        } else {
            $results = $repository->findMedia($search, $sort, $page, $pageSize);
            $results['search'] = $search;
        }
        
        return $results;
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
        return $repository->findByTag($id, $sort, $page, $pageSize);
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
        return $repository->findByCategory($id, $sort, $page, $pageSize);
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
        return $repository->findBySpeaker($id, $sort, $page, $pageSize);
    }
}
