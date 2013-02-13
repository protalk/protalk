<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Import\Base;
use Protalk\MediaBundle\Import\Helper\ImportItem;
use Protalk\MediaBundle\Entity\Feed;
use Protalk\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use SimplePie_Item;

/**
 * Feedburner import class
 * 
 * This class handles podcast feeds from Feedburner
 * 
 * @author Lineke Kerckhoffs-Willems and Kim Rowan
 */
class Feedburner extends Base
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
        $itemUploaded = new \DateTime($item->get_date());

        $content = $enclosures[0]->get_link();
        if (!$content) {
            return false;
        }

        $itemIsSuitable = $this->checkSuitableForImport($item, $itemUploaded, $feed->getLastImportedDate());
        if (!$itemIsSuitable) {
            return false;
        }

        $importItem = new ImportItem();

        $importItem->title = $item->get_title();
        $importItem->date = new \DateTime($item->get_date());
        $importItem->description = $item->get_description();
        $importItem->length = 'tbc';  //item duration must be manually added!
        $importItem->mediatype = $feed->getMediatype();
        $importItem->content = $content;
        $importItem->hostName = $feed->getName();
        $importItem->hostUrl = $item->get_permalink();

        $this->insertMedia($importItem, new Media());

        // TODO: add default language to feed entity <-- do this when multi-language support is added?

        return true;
    }
}
