<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TagController extends Controller
{
    /**
     * @Template()
     */
    public function listAction()
    {
        $tags = $this->getDoctrine()->getRepository("ProtalkMediaBundle:Tag")->findAll();
        return array('tags' => $tags);
    }
}
