<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Media Admin Controller
 * 
 * This controller handles requests to handle media administration.
 */
class MediaAdminController extends Controller
{
    /**
     * Publish media
     * 
     * This function publishes media that has been insterted previously.
     * 
     * @param ProxyQueryInterface $query
     * @return \Symfony\Component\HttpFoundation\RedirectResponse 
     */
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
