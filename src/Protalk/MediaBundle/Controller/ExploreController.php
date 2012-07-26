<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Protalk\MediaBundle\Helpers\Paginator;
use Symfony\Component\HttpFoundation\Request;


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
     * @Route("/result/{search}/{sort}/{order}", name="search_results", defaults={"search" = null, "sort" = "date", "order" = null })
     * @Template()
     */
    public function resultAction($search, $sort, $order)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        $request = Request::createFromGlobals();

        $search = $request->request->get('search', $search);
        $page = ($this->getRequest()->get('page')) ? $this->getRequest()->get('page') : 1;

        if (null == $order) {
            $order = ($sort == 'title') ? 'ASC' : 'DESC';
        } else {
            $order = $this->getRequest()->get('order');
        }

        $results = array();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');

        if (null == $search) {
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize, $order);
        } else {
            $results = $repository->findMedia($search, $sort, $page, $pageSize, $order);
        }

        return $this->_getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'search_results', $order);
    }

    /**
     * @Route("/tag/{search}/{sort}/{order}", name="tag_search", defaults={"sort" = "date", "order" = null })")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function tagAction($search, $sort, $order)
    {
        $page = ($this->getRequest()->get('page')) ? $this->getRequest()->get('page') : 1;

        if (null == $order) {
            $order = ($sort == 'title') ? 'ASC' : 'DESC';
        } else {
            $order = $this->getRequest()->get('order');
        }

        $pageSize = $this->container->getParameter('search_results_page');

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByTag($search, $sort, $page, $pageSize, $order);

        return $this->render(
                'ProtalkMediaBundle:Explore:result.html.twig',
                $this->_getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'tag_search', $order)
            );
    }

    /**
     * @Route("/category/{search}/{sort}/{order}", name="category_search", defaults={"sort" = "date", "order" = null })")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function categoryAction($search, $sort, $order)
    {
        $page = ($this->getRequest()->get('page')) ? $this->getRequest()->get('page') : 1;

        $pageSize = $this->container->getParameter('search_results_page');

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByCategory($search, $sort, $page, $pageSize, $order);

        return $this->render(
                'ProtalkMediaBundle:Explore:result.html.twig',
                $this->_getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'category_search', $order)
            );
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
     * @param string     $order
     *
     * @return array
     */
    private function _getViewParameters($results, $searchField, $search, $sort, $page, $pageSize, $route, $order)
    {
        $paginator = new Paginator($results['total'], $page , $pageSize, 7);
        $results['paginator'] = $paginator;
        $results['baseUrl'] = $this->get('router')->generate($route, array($searchField => $search, 'sort' => $sort));
        $results[$searchField] = $search;

        return $results;
    }
}
