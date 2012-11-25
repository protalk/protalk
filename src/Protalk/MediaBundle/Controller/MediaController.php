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

class MediaController extends Controller
{

    /**
     * @Route("/{slug}", name="media_show")
     * @Template()
     */
    public function indexAction($slug)
    {
        $mediaRepository = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media');
        $media = $mediaRepository->findOneBySlug($slug);

        if (is_object($media)) {
            $mediaRepository->incrementVisitCount($media);

            return array('media' => $media);
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/media/{id}/speakers", name="get_speakers", requirements={"id" = "\d+"})
     */
    public function speakersAction($id)
    {
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);

        return $this->render('ProtalkMediaBundle:Speaker:show.html.twig', array('speakers' => $media->getSpeakers()));
    }

    /**
     * @param $id
     * @param $rating
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/rate/{id}/{rating}", name="rate_media", requirements={"id" = "\d+", "rating" = "\d+"})
     */
    public function rateAction($id, $rating)
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($id);
            $em = $this->getDoctrine()->getEntityManager();

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
