<?php

namespace Protalk\MediaBundle\MediaType;

interface ProviderInterface
{
    /**
     * @abstract
     * @param $url URL for resource
     * @return bool
     */
    public function supports($url);

    /**
     * @abstract
     * @param $url URL for resource
     * @return string
     */
    public function render($url);

    /**
     * @abstract
     * @return string
     */
    public function getName();
}
