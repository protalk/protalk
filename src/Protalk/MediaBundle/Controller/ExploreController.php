<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Protalk\MediaBundle\Helpers\Paginator;

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
     * @Route("/result")
     * @Template()
     */
    public function resultAction()
    {
        $pageSize = $this->container->getParameter('search_results_page');
        
        $search = '';
        if ($this->getRequest()->get('search') != '') {
            $search = $this->getRequest()->get('search');
        }
        
        $sort = 'date';
        if ($this->getRequest()->get('sort') != '') {
            $sort = $this->getRequest()->get('sort');
        }
        
        $page = 1;
        if ($this->getRequest()->get('page') != '') {
            $page = $this->getRequest()->get('page');
        }
        
        $results = array();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        
        if ('' == $search) {    
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize);
        } else {
            $results = $repository->findMedia($search, $sort, $page, $pageSize);
        }
        
        return $this->_getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'search_results');
    }
    
    /**
     * @Route("/tag/{id}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function tagAction($id)
    {
        $sort = 'date';
        if ($this->getRequest()->get('sort') != '') {
            $sort = $this->getRequest()->get('sort');
        }
        
        $page = 1;
        if ($this->getRequest()->get('page') != '') {
            $page = $this->getRequest()->get('page');
        }
        
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByTag($id, $sort, $page, $pageSize);
        
        return $this->_getViewParameters($results, 'id', $id, $sort, $page, $pageSize, 'tag_search');
    }
    
    /**
     * @Route("/category/{id}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function categoryAction($id)
    {
        $sort = 'date';
        if ($this->getRequest()->get('sort') != '') {
            $sort = $this->getRequest()->get('sort');
        }
        
        $page = 1;
        if ($this->getRequest()->get('page') != '') {
            $page = $this->getRequest()->get('page');
        }
        
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByCategory($id, $sort, $page, $pageSize);
        
        return $this->_getViewParameters($results, 'id', $id, $sort, $page, $pageSize, 'category_search');
    }
    
    /**
     * @Route("/search/speaker/{id}")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function speakerAction($id)
    {
        $sort = 'date';
        if ($this->getRequest()->get('sort') != '') {
            $sort = $this->getRequest()->get('sort');
        }
        
        $page = 1;
        if ($this->getRequest()->get('page') != '') {
            $page = $this->getRequest()->get('page');
        }
        
        $pageSize = $this->container->getParameter('search_results_page');
        
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findBySpeaker($id, $sort, $page, $pageSize);
        
        return $this->_getViewParameters($results, 'id', $id, $sort, $page, $pageSize, 'speaker_search');
    }
    
    /**
     * Get the parameters for the view
     * 
     * @param array      $results
     * @param string     $searchField
     * @param string|int $search
     * @param int        $page
     * @param int        $pageSize
     * @param string     $route
     * 
     * @return array 
     */
    private function _getViewParameters($results, $searchField, $search, $sort, $page, $pageSize, $route)
    {
        $paginator = new Paginator($results['total'], $page , $pageSize, 7);
        $results['paginator'] = $paginator;
        $results['baseUrl'] = $this->get('router')->generate($route, array($searchField => $search, 'sort' => $sort));
        
        return $results;
    }
}
