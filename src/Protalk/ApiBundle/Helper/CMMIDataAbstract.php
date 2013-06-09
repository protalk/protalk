<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\Rest\Util\Codes;
use JoshuaEstes\Hal\Link;
use JoshuaEstes\Hal\Resource;

abstract class CMMIDataAbstract implements CMMIDataInterface
{
    /**
     * Mapping for the entity we are processing
     *
     * @var array
     */
    protected $mapping = array();

    /**
     * @var JoshuaEstes\Hal\Resource
     */
    protected $resource = null;

    /**
     * Is needed to be able to create proper href links that actually work
     * Example would be 'id' or 'slug'
     *
     * @var string identified
     */
    protected $identifier = null;

    /**
     * @param \RecursiveArrayIterator $iterator
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function buildResources(\RecursiveArrayIterator $iterator)
    {
        if(count($this->mapping) == 0) {
            throw new HttpException('Unable to generate CMMI Data, no mapping is known', Codes::HTTP_BAD_REQUEST);
        }

        $this->resource = new Resource(new Link('/location', 'self'));

        if($iterator->hasChildren()) {
            while($iterator->valid()) {
                $childItem = $iterator->current();
                $this->addResource(new \RecursiveArrayIterator($childItem));

                $iterator->next();
            }
        } else {
            $this->addResource($iterator);
        }

        // You can add more links too
        $this->resource->addLink(new Link('/location/next', 'next'));
        $this->resource->addLink(new Link('/location/previous', 'previous'));

        return $this->resource;
    }

    /**
     * @param \RecursiveArrayIterator $iterator
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return void
     */
    protected function addResource(\RecursiveArrayIterator $iterator)
    {
        if(isset($iterator[$this->identifier]) === false) {
            throw new HttpException('Cannot add resource, identified not known in the iterator', Codes::HTTP_BAD_REQUEST);
        }

        $mediaResource = new Resource(new Link('/media/' . $iterator[$this->identifier], 'self'), 'media');

        // Add the mapping to the resource
        $this->mapResource($mediaResource, $iterator);

        $this->resource->addResource($mediaResource);
    }

    /**
     * Map all the fields into the resource
     *
     * @param Resource $resource
     * @param \RecursiveArrayIterator $item
     */
    protected function mapResource(Resource $resource, \RecursiveArrayIterator $iterator)
    {
        // Map all the fields in the resource
        foreach($this->mapping as $mappingKey => $mappingValue)
        {
            if(isset($iterator[$mappingValue]) === false) {
                throw new HttpException('Cannot map resource, key "' . $mappingValue . '" not known in the iterator', Codes::HTTP_BAD_REQUEST);
            }

            $resource->$mappingKey = $iterator[$mappingValue];
        }
    }

    /**
     * Build an array that we can use to send to the client
     *
     * @param \RecursiveArrayIterator $items
     * @return array
     */
    public function buildArray(\RecursiveArrayIterator $items)
    {
        $resource = $this->buildResources($items);

        return $resource->asArray();
    }

    /**
     * Build json directly, ready to be sent to the client
     *
     * @param \RecursiveArrayIterator $items
     * @return string
     */
    public function buildJson(\RecursiveArrayIterator $items)
    {
        $resource = $this->buildResources($items);

        return $resource->asJson();
    }
}