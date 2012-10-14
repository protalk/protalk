<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
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

/**
 * Admin for comments
 * 
 * This class handles fields for the comment data.
 */
class CommentAdmin extends Admin
{
    /**
     * Configure form fields
     * 
     * This function adds name field to the form mapper object.
     * 
     * @param FormMapper $formMapper 
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name');
    }

    /**
     * Configure data grid filters
     * 
     * This function adds Name field to data grid mapper.
     * 
     * @param DatagridMapper $datagridMapper 
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * Configure list fields
     * 
     * This function configures list fields by adding identifier
     * of Name.
     * 
     * @param ListMapper $listMapper 
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    /**
     * Validator function
     * 
     * This function validates that the maximum amount of characters given for a
     * is 50 characters long.
     * 
     * @param ErrorElement $errorElement
     * @param mixed $object 
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 50))->end();
    }
}