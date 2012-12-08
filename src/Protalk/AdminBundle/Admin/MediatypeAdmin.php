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
 * Admin for media types
 *
 * This class handles fields for the media type data.
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
        $typeChoices = array(
            'autodetect' => 'autodetect',
            'video'=>'video',
            'audio'=>'audio',
        );

        $formMapper->add('name', null, array('help' => 'This is the name of the media type'))
                   ->add('type', 'choice', array('choices' => $typeChoices));
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
     * @param type         $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('name')->assertMaxLength(array('limit' => 50))->end();
        $errorElement->with('type')->assertMaxLength(array('limit' => 10))->end();
    }
}
