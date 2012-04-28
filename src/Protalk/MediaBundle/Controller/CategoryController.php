<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * @Template()
     */
    public function listAction()
    {
        $categories = $this->getDoctrine()->getRepository("ProtalkMediaBundle:Category")->findAll();
        return array('categories' => $categories);
    }
}
