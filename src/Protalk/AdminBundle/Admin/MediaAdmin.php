<?php

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class MediaAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')->add('mediatype_id')->add('speakers')->add('date')
                ->add('description')->add('length')->add('rating')->add('visits')
                ->add('content')->add('slides')->add('joindin')->add('language')
                ->add('isPublished')->add('hostName')->add('hostUrl');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('title')->assertMaxLength(array('limit' => 255))->end();
    }
}