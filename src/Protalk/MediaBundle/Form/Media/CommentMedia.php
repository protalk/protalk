<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Form\Media;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentMedia extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('author', 'text');
        $builder->add('email', 'email');
        $builder->add('website', 'url', array('required' => false));
        $builder->add('content', 'textarea');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Protalk\MediaBundle\Entity\Comment',
        );
    }

    public function getName()
    {
        return 'comment';
    }
}
