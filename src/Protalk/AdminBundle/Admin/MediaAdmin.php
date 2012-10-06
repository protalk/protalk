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
        $formMapper->add('title')
                ->add('mediatype')
                ->add('speakers', 'sonata_type_model', array('expanded' => true))
                ->add('date')
                ->add('description')
                ->add('length')
                ->add('rating')
                ->add('visits')
                ->add('content')
                ->add('slides')
                ->add('joindin')
                ->add('language')
                ->add('isPublished', null, array('required' => false))
                ->add('hostName')
                ->add('hostUrl')
                ->add('thumbnail')
                ->add('categories', 'sonata_type_model', array('expanded' => true))
                ->add('tags', 'sonata_type_model', array('expanded' => true));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('isPublished');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('title')->assertMaxLength(array('limit' => 255))->end();
    }
    
    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        $actions['unpublish']= array(
            'label'            => 'Unpublish',
            'ask_confirmation' => true
        );

        return $actions;
    }
}
