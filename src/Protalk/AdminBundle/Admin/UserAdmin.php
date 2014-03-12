<?php

namespace Protalk\AdminBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


class UserAdmin extends BaseUserAdmin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->end()
            ->with('Profile')
            ->add('firstname')
            ->add('lastname')
            ->end()
            ->with('Security')
            ->add('token')
            ->add('twoStepVerificationCode')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array('required' => false))
            ->end()
            ->with('Profile')
            ->add('firstname', 'text', array('required' => false))
            ->add('lastname', 'text', array('required' => false))
            ->add('website', 'text', array('required' => false))
            ->add('biography', 'text', array('required' => false))
            ->end();

        if (!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper->with('Management')
                ->add(
                    'roles',
                    'sonata_security_roles',
                    array(
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false
                    )
                )
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end();
        }

        $formMapper
            ->with('Security')
            ->add('token', null, array('required' => false))
            ->add('twoStepVerificationCode', null, array('required' => false))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('enabled', null, array('editable' => true))
            ->add('locked', null, array('editable' => true))
            ->add('createdAt')
        ;

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper
                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('locked')
            ->add('email')
        ;
    }
}
