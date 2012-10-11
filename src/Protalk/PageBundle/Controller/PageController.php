<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $this->getPage($url);
        return array('page' => $this->page);
    }

    /*
     * Displays page content text from database
     *
     * @param string $url
     * @return template
     */
    public function contentAction($url)
    {
        $this->getPage($url);
        return $this->render('ProtalkPageBundle:Page:content.html.twig', array('page' => $this->page));
    }

    /*
     * Retrieves page content text from database
     *
     * @param string $url
     * @return boolean
     */
    protected function getPage($url)
    {
        $this->page = $this->getDoctrine()->getRepository('ProtalkPageBundle:Page')->findOneByUrl($url);
        if (!is_object($this->page)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        return true;
    }
}
