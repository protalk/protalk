<?php
/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProtalkUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}