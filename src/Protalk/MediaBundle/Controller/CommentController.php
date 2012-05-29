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
        $request = $this->getRequest();
        $media = $this->getDoctrine()->getRepository('ProtalkMediaBundle:Media')->findOneById($request->get('media_id'));

        $comment = new Comment();
        $comment->setMedia($media);
        $comment->setMediaId($media->getId());

        $form = $this->createForm(new CommentMedia(), $comment);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $comment = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($comment);
                $em->flush();

                return $this->redirect($this->generateUrl('media_show', array('slug' => $media->getSlug())));
            }
        }

        return $this->render('ProtalkMediaBundle:Comment:new.html.twig', array('form' => $form->createView(), 'media' => $media));
    }
}
