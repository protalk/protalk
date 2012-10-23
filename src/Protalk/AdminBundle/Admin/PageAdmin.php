<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012, Steffan Harries <contact@steffanharries.me.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class PageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('url')->add('pageTitle')->add('title')->add('content');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('pageTitle');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('url');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('pageTitle')
            ->assertMaxLength(array('limit' => 100))
            ->end()
            ->with('url')
            ->assertMaxLength(array('limit' => 100))
            ->end();
    }
}
