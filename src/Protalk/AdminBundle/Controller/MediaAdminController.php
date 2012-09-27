<?php

namespace Protalk\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MediaAdminController extends Controller
{
    public function batchActionUnpublish(ProxyQueryInterface $query)
    {
        $em = $this->getDoctrine()->getEntityManager();

        foreach ($query->getQuery()->iterate() as $entity) {
            $entity[0]->setIsPublished(false);
            $em->persist($entity[0]);
        }
        $em->flush();
        
        $this->get('session')->setFlash('sonata_flash_success', 'flash_batch_merge_success');

        return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
    }
}
