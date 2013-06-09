<?php

namespace Protalk\ApiBundle\Helper;

use Protalk\ApiBundle\Helper\CMMIDataInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\Rest\Util\Codes;
use JoshuaEstes\Hal\Link;
use JoshuaEstes\Hal\Resource;

abstract class CMMIDataDetailAbstract implements CMMIDataInterface
{
    /**
     * Field that we use to fetch the ID for the href link
     *
     * @var string
     */
    protected $idField = 'id';

    /**
     * Mapping for the entity we are processing
     *
     * @var array
     */
    protected $mapping = array();

    protected function buildResources(\RecursiveArrayIterator $item)
    {
        if(!is_array($this->mapping) || count($this->mapping == 0)) {
            throw new HttpException('Unable to generate CMMI Data, no mapping is known', Codes::HTTP_BAD_REQUEST);
        }

        $resource = new Resource(new Link('/location', 'self'));

        $mediaResource        = new Resource(new Link('/media/' . $item->{$this->idField}, 'self'), 'media');

        $this->mapResource($mediaResource, $item);

        $resource->addResource($mediaResource);

        // You can add more links too
        $resource->addLink(new Link('/location/next', 'next'));
        $resource->addLink(new Link('/location/previous', 'previous'));

        return $resource;
    }

    /**
     * Map all the fields into the resource
     *
     * @param Resource $resource
     * @param \RecursiveArrayIterator $item
     */
    protected function mapResource(Resource $resource, \RecursiveArrayIterator $item)
    {
        // Map all the fields in the resource
        foreach($this->mapping as $mappingKey => $mappingValue)
        {
            if(isset($item->$mappingValue)) {
                $resource->$mappingKey = $item->$mappingValue;
            }
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