<?php

namespace Protalk\MediaBundle\Controller;

use Protalk\MediaBundle\Form\Media\CommentMedia;
use Protalk\MediaBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CommentController extends Controller
{

    public function newAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm(new CommentMedia(), $comment);

        $request = $this->getRequest();

      //  var_dump($request->get('media_id'));die;
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($request->get('media_id'));

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $comment = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($comment);
                $em->flush();

                return $this->redirect($this->generateUrl('media_show', array('slug' => $media->get('slug'))));
            }
        }

        return $this->render('ProtalkMediaBundle:Comment:new.html.twig', array('form' => $form->createView(), 'media' => $media));
    }

}
