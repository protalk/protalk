<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Import\Base;
use Protalk\MediaBundle\Import\Helper\ImportItem;
use Protalk\MediaBundle\Entity\Feed;
use Protalk\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use SimplePie_Item;

/**
 * YouTube import class
 *
 * This class handles feeds from YouTube
 *
 * @author Kim Rowan
 */
class YouTube extends Base
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
        $data = $item->get_item_tags('http://search.yahoo.com/mrss/', 'group');
        $enclosures = $item->get_enclosures();

        $schemaArray = $data[0]['child']['http://gdata.youtube.com/schemas/2007'];
        $videoId = $schemaArray['videoid'][0]['data'];
        if (!$videoId) {
            return false;
        }

        $itemUploaded = new \DateTime($schemaArray['uploaded'][0]['data']);

        $itemIsSuitable = $this->checkSuitableForImport($item, $itemUploaded, $feed->getLastImportedDate());
        if (!$itemIsSuitable) {
            return false;
        }

        $duration = gmdate("H:i:s", $enclosures[0]->get_duration());
        $contentTemplate = "<iframe width=\"500\" height=\"315\" src=\"http://www.youtube.com/embed/".$videoId."\" frameborder=\"0\" allowfullscreen></iframe>";

        $importItem = new ImportItem();

        $importItem->title = $item->get_title();
        $importItem->date = new \DateTime($item->get_date());
        $importItem->description = $enclosures[0]->get_description();
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