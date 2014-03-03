<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Admin for comments
 *
 * This class handles fields for the comment data.
 *
 * @category   AdminBundle
 * @author     <author>
 * @copyright  2012-2013 ProTalk
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       https://github.com/protalk/protalk
 * @link       http://www.protalk.me
 */

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class CommentAdmin extends Admin
{
    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) 
    {
        $collection->remove('create');
    }
    
    /**
     * Configure form fields
     *
     * This function adds name field to the form mapper object.
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('author')
                   ->add('email')
                   ->add('website')
                   ->add('datetime')
                   ->add('content');
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
        $datagridMapper->add('author');
    }

    /**
     * Configure list fields
     *
     * This function configures list fields by adding identifier
     * of Name.
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('author')
                   ->add('email')
                   ->add('datetime');
    }

    /**
     * Validator function
     *
     * This function validates that the maximum amount of characters given for a
     * is 50 characters long.
     *
     * @param ErrorElement $errorElement
     * @param mixed        $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertLength(array('max' => 50))->end();
    }
}
