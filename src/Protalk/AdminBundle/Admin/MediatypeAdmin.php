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
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', null, array('help' => 'This is the name of the media type'))
                   ->add('type', 'choice', array('choices' => array(
                                                                'video'=>'video', 
                                                                'audio'=>'audio')));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('type');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 50))->end();
        $errorElement->with('type')->assertMaxLength(array('limit' => 10))->end();
    }
}