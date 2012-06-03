<?php

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Protalk\MediaBundle\Entity\Rating;

class MediaController extends Controller
{

    /**
     * @Route("/home")
     * @Template()
     */
    public function indexAction($slug)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneBySlug($slug);

        if (is_object($media)) {
            $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->incrementVisitCount($media);
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

    public function rateAction($id, $rating)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);

        $currentRating = $media->getRating();

        $newRating = new Rating();
        $newRating->setRating($rating);
        // relate this rating to the media object
        $media->addRating($newRating);
        // update the running total stored in the media record
        $media->setRating($currentRating + $rating);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($newRating);
        $em->persist($media);
        $em->flush();
    }

}
