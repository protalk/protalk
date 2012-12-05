<?php

namespace Protalk\MediaBundle\MediaType;

class Manager
{
    private $providers;

    public function __construct()
    {
        $this->providers = array();
    }

    public function addProvider($provider, $alias)
    {
        $this->providers[$alias] = $provider;
    }
}
