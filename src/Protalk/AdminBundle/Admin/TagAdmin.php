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
 * Admin for tags
 * 
 * This class handles fields for the tags data.
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

class TagAdmin extends Admin
{
    /**
     * Form fields configuration
     * 
     * This function adds Name to the form mapper.
     * 
     * @param FormMapper $formMapper 
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name')->add('slug');
    }

    /**
     * Datagrid filters configuration
     * 
     * This function adds Name to the datagrid mapper.
     * 
     * @param DatagridMapper $datagridMapper 
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')->add('slug');
    }

    /**
     * List fields configuration
     * 
     * This function adds Name identifier to the list mapper.
     * 
     * @param ListMapper $listMapper 
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')->add('slug');
    }

    /**
     * Validator class
     * 
     * This function validates that Name is no longer that 50 characters long.
     * 
     * @param ErrorElement $errorElement
     * @param type $object 
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
        ->with('name')
        ->assertMaxLength(array('limit' => 50))
        ->end();
    }
}
