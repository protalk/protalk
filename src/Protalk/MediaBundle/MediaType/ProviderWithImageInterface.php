<?php

namespace Protalk\MediaBundle\MediaType;

interface ProviderWithImageInterface extends ProviderInterface
{
    /**
     * @abstract
     * @param $url string URL for resource
     * @return mixed
     */
    public function thumb($url);
}
