<?php

namespace Protalk\ApiBundle\Helper;

interface CMMIDataInterface
{
    public function buildArray(\RecursiveArrayIterator $items);

    public function buildJson(\RecursiveArrayIterator $items);
}