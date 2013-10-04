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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Protalk\MediaBundle\Entity\Rating;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;

class MediaController extends Controller
{

    /**
     * @Route("/{slug}", name="media_show")
     * @Template()
     */
    public function indexAction($slug)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $media = $mediaRepository->findOneBySlug($slug, Query::HYDRATE_OBJECT);

        if (is_object($media)) {
            if (!$this->get("session")->get("hasViewedInThisSession")) {
                $this->get("session")->set("hasViewedInThisSession", true);
                $mediaRepository->incrementVisitCount($media);
            }
            return array('media' => $media);
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }

    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @Route("/media/speakers/{slug}", name="get_speakers")
     */
    public function speakersAction($slug)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneBy(array('slug' => $slug));

        if (!is_object($media)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }

        $speakers = array();
        foreach ( $media->getSpeakers() as $mediaSpeaker) {
            $speakers[] = $mediaSpeaker->getSpeaker();
        }
        return $this->render('ProtalkMediaBundle:Speaker:show.html.twig', array('speakers' => $speakers));
    }

    /**
     * @param $id
     * @param $rating
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @Route("/rate/{id}/{rating}", name="rate_media", requirements={"id" = "\d+", "rating" = "\d+"})
     */
    public function rateAction($id, $rating)
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);

            if (!is_object($media)) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            }

            $em = $this->getDoctrine()->getManager();

            $newRating = new Rating();
            $newRating->setRating($rating);
            $newRating->setIpaddress($this->container->get('request')->getClientIp());
            $newRating->setMedia($media);

            $em->persist($newRating);
            $em->flush();

            $newAverage = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->getAverageRating($id);

            // relate this rating to the media object
            $media->addRating($newRating);
            // update the running total stored in the media record
            $media->setRating($newAverage);
            $em->persist($media);
            $em->flush();

            return $this->forward('ProtalkMediaBundle:Rating:index', array('rating' => $media->getRating()));
        }
    }
}
