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

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Protalk\MediaBundle\Helpers\ExploreSortOptions;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Protalk\MediaBundle\Helpers\Paginator;
use Symfony\Component\HttpFoundation\Request;

class ExploreController extends Controller
{
    /**
     * @Route("/explore", name="explore")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Category');
        $categories = $repository->getAllCategories();

        return array('categories' => $categories);
    }

    /**
     * @Route("/result/{search}/{sort}/{order}",
     *        name="search_results",
     *        defaults={"search" = "all", "sort" = "date", "order" = "desc" })
     * @Template()
     */
    public function resultAction($search, $sort, $order)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        $request = Request::createFromGlobals();

        $search = $request->request->get('search', $search);
        $order = $request->request->get('order', $order);
        $page = $this->getRequest()->get('page', 1);

        if (!ExploreSortOptions::verifySortOption($sort, $order)) {
            throw new AccessDeniedHttpException("The given sort option '$sort $order' is not supported");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');

        if ('all' == $search) {
            $results = $repository->getMediaOrderedBy($sort, $page, $pageSize, $order);
        } else {
            $results = $repository->findMedia($search, $sort, $page, $pageSize, $order);
        }

        return $this->getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'search_results', $order);
    }

    /**
     * @Route("/tag/{search}/{sort}/{order}", name="tag_search", defaults={"sort" = "date", "order" = "desc" })")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function tagAction($search, $sort, $order)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        $request = Request::createFromGlobals();

        $order = $request->request->get('order', $order);
        $page = $this->getRequest()->get('page', 1);

        if (!ExploreSortOptions::verifySortOption($sort, $order)) {
            throw new AccessDeniedHttpException("The given sort option '$sort $order' is not supported");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByTag($search, $sort, $page, $pageSize, $order);

        return $this->render(
            'ProtalkMediaBundle:Explore:result.html.twig',
            $this->getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'tag_search', $order)
        );
    }

    /**
     * @Route("/category/{search}/{sort}/{order}",
     *        name="category_search", defaults={"sort" = "date", "order" = "desc" })
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function categoryAction($search, $sort, $order)
    {
        $pageSize = $this->container->getParameter('search_results_page');
        $request = Request::createFromGlobals();

        $order = $request->request->get('order', $order);
        $page = $this->getRequest()->get('page', 1);

        if (!ExploreSortOptions::verifySortOption($sort, $order)) {
            throw new AccessDeniedHttpException("The given sort option '$sort $order' is not supported");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findByCategory($search, $sort, $page, $pageSize, $order);

        return $this->render(
            'ProtalkMediaBundle:Explore:result.html.twig',
            $this->getViewParameters($results, 'search', $search, $sort, $page, $pageSize, 'category_search', $order)
        );
    }

    /**
     * @Route("/search/speaker/{search}", name="speaker_search")
     * @Template("ProtalkMediaBundle:Explore:result.html.twig")
     */
    public function speakerAction($search)
    {
        $sort = 'date';
        if ($this->getRequest()->get('sort') != '') {
            $sort = $this->getRequest()->get('sort');
        }

        $order = 'asc';
        if ($this->getRequest()->get('order') != '') {
            $order = $this->getRequest()->get('order');
        }

        $page = 1;
        if ($this->getRequest()->get('page') != '') {
            $page = $this->getRequest()->get('page');
        }

        $pageSize = $this->container->getParameter('search_results_page');

        if (!ExploreSortOptions::verifySortOption($sort, $order)) {
            throw new AccessDeniedHttpException("The given sort option '$sort' is not supported");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $results = $repository->findBySpeaker($search, $sort, $page, $pageSize);

        return $this->getViewParameters($results, 'id', $search, $sort, $page, $pageSize, 'speaker_search', 'id');
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
    private function getViewParameters($results, $searchField, $search, $sort, $page, $pageSize, $route, $order)
    {
        $paginator = new Paginator($results['total'], $page, $pageSize, 7);
        $results['search'] = $search;
        $results['paginator'] = $paginator;
        $results[$searchField] = $search;
        $results['order'] = $order;
        $results['sort'] = $sort;
        $results['availableSortOptions'] = ExploreSortOptions::getAvailableSortOptions();

        return $results;
    }
}
