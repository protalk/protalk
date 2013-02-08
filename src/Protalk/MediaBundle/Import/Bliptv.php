<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Import\Base;
use Protalk\MediaBundle\Import\Helper\ImportItem;
use Protalk\MediaBundle\Entity\Feed;
use Protalk\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use SimplePie_Item;

/**
 * Bliptv import class
 * 
 * This class handles feeds from Bliptv
 * 
 * @author Lineke Kerckhoffs-Willems and Kim Rowan
 */
class Bliptv extends Base
{
    /**
     * Handle import
     *
     * @param \SimplePie_Item $item
     * @param \Protalk\MediaBundle\Entity\Feed $feed
     * @return bool
     */
    public function handleImport(SimplePie_Item $item, Feed $feed)
    {
        $enclosures = $item->get_enclosures();

        $videoId = $item->get_item_tags('http://blip.tv/dtd/blip/1.0', 'embedLookup');
        $videoId = $videoId[0]['data'];

        $contentTemplate = "<iframe src=\"http://blip.tv/play/".$videoId.".html?p=1\" width=\"532\" height=\"334\" frameborder=\"0\" allowfullscreen></iframe><embed type=\"application/x-shockwave-flash\" src=\"http://a.blip.tv/api.swf#".$videoId."\" style=\"display:none\"></embed>";

        $itemUploaded = $item->get_item_tags('http://blip.tv/dtd/blip/1.0', 'datestamp');
        $itemUploaded = new \DateTime($itemUploaded[0]['data']);

        $itemIsSuitable = $this->checkSuitableForImport($item, $itemUploaded, $feed->getLastImportedDate());
        if (!$itemIsSuitable) {
            return false;
        }

        $duration = $item->get_item_tags('http://blip.tv/dtd/blip/1.0', 'runtime');
        $duration = gmdate("H:i:s", $duration[0]['data']);

        $description = $item->get_item_tags('http://blip.tv/dtd/blip/1.0', 'puredescription');
        $description = $description[0]['data'];

        $importItem = new ImportItem();

        $importItem->title = $item->get_title();
        $importItem->date = new \DateTime($item->get_date());
        $importItem->description = $description;
        $importItem->length = $duration;
        $importItem->mediatype = $feed->getMediatype();
        $importItem->content = $contentTemplate;
        $importItem->hostName = $feed->getName();
        $importItem->hostUrl = $item->get_permalink();
        $importItem->thumbnail = $enclosures[0]->get_thumbnail(0);

        $this->insertMedia($importItem, new Media());

        // TODO: add default language to feed entity <-- do this when multi-language support is added?

        return true;
    }
}
