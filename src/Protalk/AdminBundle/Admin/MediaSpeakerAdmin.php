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
 * Admin for media speakers
 *
 * This class handles fields for the media speaker data.
 *
 * @category   AdminBundle
 * @author     Lineke Kerckhoffs-Willems <lineke@protalk.me>
 * @copyright  2012-2013 ProTalk
 * @license    http://opensource.org/licenses/mit-license.php MIT
 * @link       https://github.com/protalk/protalk
 * @link       http://www.protalk.me
 */

namespace Protalk\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MediaSpeakerAdmin extends Admin
{
    protected $parentAssociationMapping = 'media';

    /**
     * Form fields configuration
     *
     * This function adds Name to the form mapper.
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $speakerQuery = $this->modelManager
                             ->getEntityManager('Protalk\MediaBundle\Entity\Speaker')
                             ->createQuery(
                                 'SELECT s
                                  FROM ProtalkMediaBundle:speaker s
                                  ORDER BY s.name ASC'
                             );
        
        $formMapper->add('speaker',
                         'sonata_type_model',
                         array(
                             'class' => 'Protalk\MediaBundle\Entity\Speaker',
                             'property' => 'name',
                             'query' => $speakerQuery
                         ));
    }

    /**
     * Configure list fields
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('speaker')
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                )
            );
    }
}