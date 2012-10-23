<?php

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ContributionAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('category')
                ->add('name')
                ->add('email')
                ->add('hostUrl')
                ->add('hostName')
                ->add('title')
                ->add('slidesUrl')
                ->add('speaker')
                ->add('description')
                ->add('tags');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('email')->add('title');
    }
}
