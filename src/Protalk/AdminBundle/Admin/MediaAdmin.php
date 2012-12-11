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
 * Admin for media
 *
 * This class handles fields for the media data.
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

class MediaAdmin extends Admin
{
    /**
     * Configure form fields
     *
     * This function creates a form for the media.
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
                ->add('mediatype')
                ->add(
                    'speakers',
                    'sonata_type_model',
                    array(
                        'expanded' => true,
                        'compound' => true,
                        'multiple' => true
                    )
                )
                ->add('date')
                ->add('description')
                ->add('length')
                ->add('rating', null, array('required' => false))
                ->add('visits', null, array('required' => false))
                ->add('content')
                ->add('slides')
                ->add('joindin')
                ->add('language')
                ->add('isPublished', null, array('required' => false))
                ->add('hostName')
                ->add('hostUrl')
                ->add('thumbnail')
                ->add(
                    'categories',
                    'sonata_type_model',
                    array(
                        'expanded' => true,
                        'compound' => true,
                        'multiple' => true
                    )
                )
                ->add(
                    'tags',
                    'sonata_type_model',
                    array(
                        'expanded' => true,
                        'compound' => true,
                        'multiple' => true
                    )
                );
    }

    /**
     * Configure data grid filters
     *
     * This function add Title to datagrid mapper.
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    /**
     * Configure list fields
     *
     * This function adds isPublished identifier to the Title.
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')->add('isPublished');
    }

    /**
     * Validator function
     *
     * This function validates that title of the media is no longer
     * than 255 characters long.
     *
     * @param ErrorElement $errorElement
     * @param type $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement->with('title')->assertMaxLength(array('limit' => 255))->end();
    }

    /**
     * Get batch actions for media
     *
     * This function retrieves the default (currently only the delete action) actions.
     *
     * @return array $action container for different actions for media
     */
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        $actions['unpublish']= array(
            'label'            => 'Unpublish',
            'ask_confirmation' => true
        );

        return $actions;
    }

    public function supportsPreviewMode()
    {
        return true;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'preview':
                return 'ProtalkMediaBundle:Media:preview.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
