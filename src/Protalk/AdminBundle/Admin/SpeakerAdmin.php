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
 * Admin for speakers
 * 
 * This class handles fields for the speakers data.
 */
class SpeakerAdmin extends Admin
{
    /**
     * Form field configuration
     * 
     * This function adds name, photo and biography data to the
     * form mapper.
     * 
     * @param FormMapper $formMapper 
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')->add('photo')->add('biography');
    }

    /**
     * Datagrid configuration
     * 
     * This function adds Name to the datagrid mapper.
     * 
     * @param DatagridMapper $datagridMapper 
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * List fields configuration
     * 
     * This function adds biography to the name field.
     * 
     * @param ListMapper $listMapper 
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('biography');
    }

    /**
     * Validator function
     * 
     * This function validates that name is no more tan 100 characters long.
     * 
     * @param ErrorElement $errorElement
     * @param mixed $object 
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 100))->end();
    }
}