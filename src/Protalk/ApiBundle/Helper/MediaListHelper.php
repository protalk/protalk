<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataAbstract;

class MediaListHelper extends CMMIDataAbstract
{
    /**
     * Is needed to be able to create proper href links that actually work
     * @var string identified
     */
    protected $identifier = 'slug';

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