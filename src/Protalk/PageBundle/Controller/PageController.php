<?php

namespace Protalk\PageBundle\Controller;

use Protalk\MediaBundle\Entity\Contribution;
use Protalk\MediaBundle\Form\Media\ContributeMedia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
    /**
     * @Route("/{url}")
     * @Template()
     */
    public function indexAction($url)
    {
        // get the page by url
        $page = $this->getDoctrine()->getRepository('ProtalkPageBundle:Page')->findOneByUrl($url);

        if (!is_object($page))
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();

        $contribution = new Contribution();
        $form = $this->createForm(new ContributeMedia(), $contribution);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as saving the task to the database

                $contribution = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($contribution);
                $em->flush();

                $this->get('session')->setFlash('contribution-notice', 'Thank you! Your contribution has been received.');

                return $this->redirect($this->generateUrl('page_show', array('url' => 'contribute')));
            }
        }

        return array(
                'page' => $page,
                'form' => $form->createView()
                    );

    }
}
