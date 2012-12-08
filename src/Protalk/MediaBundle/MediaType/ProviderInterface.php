<?php

namespace Protalk\MediaBundle\MediaType;

interface ProviderInterface
{
    /**
     * @abstract
     * @param $url string URL for resource
     * @return bool
     */
    public function supports($url);

    /**
     * @abstract
     * @param $url string URL for resource
     * @param \Twig_Environment $twig
     * @return string
     */
    public function render($url, \Twig_Environment $twig);

    /**
     * @abstract
     * @param $url string URL for resource
     * @return mixed
     */
    public function thumb($url);
    /**
     * @abstract
     * @return string
     */
    public function getName();
}
