<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataAbstract;

class MediaDetailHelper extends CMMIDataAbstract
{
    /**
     * Mapping specifically for media detail items
     *
     * @var array
     */
    protected $mapping = array(
        'title' => 'title',
        'content'   => 'content'
    );
}