<?php

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
    $speakers = $this->getDoctrine()->getRepository("ProtalkMediaBundle:Speaker")->findAll();
    return array('speakers' => $speakers);
  }

  public function showAction($id, $name)
  {

    $request = $this->getRequest();
    if ($request->isXmlHttpRequest())
    {
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
