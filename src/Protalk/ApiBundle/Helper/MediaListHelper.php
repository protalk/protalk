<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataListAbstract;

class MediaListHelper extends CMMIDataListAbstract
{
    /**
     * Mapping specifically for media list items
     *
     * @var array
     */
    protected $mapping = array(
        'title' => 'title',
        'content'   => 'content'
    );
}