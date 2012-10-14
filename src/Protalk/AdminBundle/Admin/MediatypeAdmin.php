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
 * Admin for media types
 * 
 * This class handles fields for the media type data.
 */
class MediatypeAdmin extends Admin
{
    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1, 
        '_sort_order' => 'ASC',
        '_sort_by' => 'name' 
    );
    
    /**
     * Cofigure form fields
     * 
     * This function adds name and type to the form.
     * 
     * @param FormMapper $formMapper 
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', null, array('help' => 'This is the name of the media type'))
                   ->add('type', 'choice', array('choices' => array(
                                                                'video'=>'video', 
                                                                'audio'=>'audio')));
    }

    /**
     * Data grid configuration
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
     * This function adds identifier of Type to Name.
     * 
     * @param ListMapper $listMapper 
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('type');
    }

    /**
     * Validator function
     * 
     * This function validates name to me no more than 50 characters long
     * and type of no more than 10 characters long.
     * 
     * @param ErrorElement $errorElement
     * @param type $object 
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 50))->end();
        $errorElement->with('type')->assertMaxLength(array('limit' => 10))->end();
    }
}