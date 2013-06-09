<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataAbstract;

class SpeakerListHelper extends CMMIDataAbstract
{
    /**
     * Is needed to be able to create proper href links that actually work
     * @var string identified
     */
    protected $identifier = 'id';

    /**
     * Mapping specifically for speaker list items
     *
     * @var array
     */
    protected $mapping = array(
        'name'          => 'name'
    );
}