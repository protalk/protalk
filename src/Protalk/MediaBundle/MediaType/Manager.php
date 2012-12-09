<?php

namespace Protalk\MediaBundle\MediaType;

use Protalk\MediaBundle\MediaType\ProviderInterface;

class Manager extends \Twig_Extension
{
    /** @var \Twig_Environment */
    private $twig;

    /** @var ProviderInterface[] */
    private $providers;

    public function __construct()
    {
        $this->providers = array();
    }

    public function addProvider(ProviderInterface $provider, $alias)
    {
        $this->providers[$alias] = $provider;
    }


    /**
     * Initializes the runtime environment.
     *
     * This is where you can load some file that contains filter functions for instance.
     *
     * @param \Twig_Environment $environment The current Twig_Environment instance
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->twig = $environment;
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            'render_media_type'  => new \Twig_Filter_Method($this, 'render'),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'protalk_media_type_manager';
    }

    public function render($url, $type = null)
    {
        if (null !== $type) {
            if (!isset($this->providers[$type])) {
                throw new \InvalidArgumentException('Type "'.$type.'" is not registered in '.__CLASS__);
            }
            return $this->providers[$type]->render($url, $this->twig);
        }

        foreach ($this->providers as $provider) {
            if ($provider->supports($url)) {
                return $provider->render($url, $this->twig);
            }
        }

        throw new \InvalidArgumentException('Url "'.$url.'" is not is not supported in '.__CLASS__);
    }
}
