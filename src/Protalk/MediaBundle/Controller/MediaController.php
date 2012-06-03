<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MediaController extends Controller
{
    /**
     * @Route("/home")
     * @Template()
     */
    public function indexAction($slug)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $media = $mediaRepository->findOneBySlug($slug);

        if (is_object($media)) {
            $mediaRepository->incrementVisitCount($media);
            return array('media' => $media);
        }
        else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }

    public function speakersAction($id)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);
        return $this->render('ProtalkMediaBundle:Speaker:show.html.twig', array('speakers' => $media->getSpeakers()));
    }
}
