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

class SpeakerController extends Controller {

    /**
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Speaker');
        $speakers = $repository->getAllSpeakers();

        return array('speakers' => $speakers);
    }

    public function showAction($id, $name)
    {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $speaker[] = $this->getDoctrine()
                ->getRepository('ProtalkMediaBundle:Speaker')
                ->find($id);

            if (!$speaker) {
                throw $this->createNotFoundException($name.' not found with id '.$id);
            }

            return $this->render('ProtalkMediaBundle:Speaker:show.html.twig', array('speakers' => $speaker));
        }

        throw new \Exception('Naughty naughty! This should be an ajax request.');
    }
}
