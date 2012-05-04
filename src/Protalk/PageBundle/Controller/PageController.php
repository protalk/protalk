<?php

namespace Protalk\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{

    /**
     * @Route("/{url}")
     * @Template()
     */
    public function indexAction($url)
    {
        // get the page by url
        $page = $this->getDoctrine()->getRepository('ProtalkPageBundle:Page')->findOneByUrl($url);

        if (!is_object($page))
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();

        if ($url == 'contribute') {

            return $this->render('ProtalkPageBundle:Page:content.html.twig', array('page' => $page));
        }

        return array('page' => $page);
    }

    /*
     * Displays page content text from database
     *
     * @return template
     */
    public function contentAction($page)
    {
        return $this->render('ProtalkPageBundle:Page:content.html.twig', array('page' => $page));
    }

}
