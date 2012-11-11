<?php

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FeedAdmin extends Admin
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
        $formMapper->add('name')
                   ->add('feedtype')
                   ->add('url')
                   ->add('automaticImport')
                   ->add('contact')
                   ->add(
                       'confirmation',
                       'choice',
                       array(
                           'choices' => array(
                               'none' => '',
                               'email' => 'Email',
                               'twitter' => 'Twitter',
                               'person' => 'In person'
                           )
                       )
                   )
                   ->add('remark');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('feedtype')->add('url');
    }
}
