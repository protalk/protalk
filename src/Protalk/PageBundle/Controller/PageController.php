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

    public function getContributorsAction()
    {
        $buzz = $this->container->get('buzz');
        $response = $buzz->get('https://api.github.com/repos/protalk/protalk/contributors');
        $contributors = json_decode($response->getContent(), true);

     

        foreach ($contributors as $key => $row) {
            $contributions[$key] = $row['contributions'];
            //var_dump( $contributions);
        }

       // $contributors = array_multisort($contributions, SORT_DESC, $contributors);

       // print_r($contributors);die;

        return $this->render('ProtalkPageBundle:Page:contributors.html.twig',array('contributors' => $contributors));
    }
}
