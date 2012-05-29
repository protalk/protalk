<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MediaController extends Controller
{
    public function indexAction($slug)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneBySlug($slug);

        if (is_object($media)) return array('media' => $media);
        else throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    public function speakersAction($id)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);
        return $this->render('ProtalkMediaBundle:Speaker:show.html.twig', array('speakers' => $media->getSpeakers()));
    }
}
