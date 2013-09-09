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
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Protalk\MediaBundle\Entity\Media;

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
                ->add('date')
                ->add('description')
                ->add('length')
                ->add('rating', null, array('required' => false))
                ->add('visits', null, array('required' => false))
                ->add('content')
                ->add('slides')
                ->add('joindin')
                ->add('language')
                ->add(
                    'status',
                    'choice',
                    array(
                        'choices' => array(
                            ''                         => 'Please select a status',
                            Media::STATUS_PENDING      => 'pending',
                            Media::STATUS_PUBLISHED    => 'published',
                            Media::STATUS_UNPUBLISHED  => 'unpublished',
                            Media::STATUS_REJECTED     => 'rejected'
                        )
                    )
                )
                ->add('hostName')
                ->add('hostUrl')
                ->add('thumbnail');
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
        $datagridMapper->add('title')
            ->add('isImported')
            ->add('hostName')
            ->add(
                'status',
                null,
                array(),
                'choice',
                array(
                    'choices' => array(
                        Media::STATUS_PENDING      => 'pending',
                        Media::STATUS_PUBLISHED    => 'published',
                        Media::STATUS_UNPUBLISHED  => 'unpublished',
                        Media::STATUS_REJECTED     => 'rejected'
                    )
                )
            );
    }

    /**
     * Configure list fields
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('status')
            ->add('isImported');
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
    
    /**
     * Add the speakers, categories and tags to the media item
     * 
     * @param \Protalk\MediaBundle\Entity\Media $media 
     */
    public function prePersist($media)
    {
        $this->setMedia($media, 'speakers');
        $this->setMedia($media, 'tags');
        $this->setMedia($media, 'languageCategory');
    }
    
    /**
     * Pre update 
     * 
     * @param mixed $object
     * 
     * @return mixed|void
     */
    public function preUpdate($media)
    {
        $this->setMedia($media, 'speakers');
        $this->setMedia($media, 'tags');
        $this->setMedia($media, 'languageCategory');
    }
    
    /**
     * Generic method to set media for a certain relation
     * 
     * @param \Protalk\MediaBundle\Entity\Media $media
     * @param string                            $type
     */
    private function setMedia($media, $type)
    {
        $method = 'get'.$type;
        $result = $media->$method();
        foreach ($result as $index => $res) {
            $result[$index]->setMedia($media);
        }
        $method = 'set'.$type;
        $media->$method($result);
    }

    /**
     * Add links to child entity lists in menu side bar
     *
     * @param MenuItemInterface $menu
     * @param $action
     * @param AdminInterface $childAdmin
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'Speakers',
            array('uri' => $admin->generateUrl('protalk.common.admin.mediaspeaker.list', array('id' => $id)))
        );

        $menu->addChild(
            'Categories',
            array('uri' => $admin->generateUrl('protalk.common.admin.medialanguagecategory.list', array('id' => $id)))
        );

       $menu->addChild(
            'Tags',
            array('uri' => $admin->generateUrl('protalk.common.admin.mediatag.list', array('id' => $id)))
        );
    }
}
