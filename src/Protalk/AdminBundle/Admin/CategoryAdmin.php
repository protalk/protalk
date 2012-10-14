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
 * Admin for categories
 * 
 * This class handles fields for the category data.
 */
class CategoryAdmin extends Admin
{
    /**
     * Configure form fields
     * 
     * This function adds parent_id as required field to the form mapper object.
     * 
     * @param FormMapper $formMapper 
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')->add('parent_id', null, array('required' => false));
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
     * of Name to parent_id.
     * 
     * @param ListMapper $listMapper 
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('parent_id');
    }

    /**
     * Validator function
     * 
     * This function validares an object and assets max length of 50 characters.
     * 
     * @param ErrorElement $errorElement
     * @param mixed $object 
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 50))->end();
    }
}