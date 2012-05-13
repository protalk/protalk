<?php

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class MediatypeAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')
                   ->add('type', 'choice', array('choices' => array('video'=>'video', 'audio'=>'audio')));
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