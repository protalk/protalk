<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Entity\Media;
use Protalk\MediaBundle\Entity\Feed;
use Doctrine\ORM\EntityManager;
use SimplePie_Item;

/**
 * Base Import class
 *
 * This class handles the imports, this is the base class because every feedtype
 * should have it's own implementation based on this class
 *
 * @author Lineke Kerckhoffs-Willems
 */
abstract class Base
{
    /**
     * Handle import
     *
     * @param \SimplePie_Item                    $item
     * @param \Protalk\MediaBundle\Entity\Feed   $feed
     * @param \Doctrine\ORM\EntityManager        $em
     */
    abstract public function handleImport(\SimplePie_Item $item, Feed $feed, EntityManager $em);

    /**
     * Insert media item
     *
     * @param \Doctrine\ORM\EntityManager   $em
     * @param object                        $importItem
     */
    protected function insertMedia(EntityManager $em, $importItem)
    {
        $media = new Media();
        $media->setTitle($importItem->title);
        $media->setDate($importItem->date);
        $media->setDescription($importItem->description);
        $media->setMediatype($importItem->mediatype);
        $media->setLength($importItem->length);
        $media->setContent($importItem->content);
        $media->setLanguage($importItem->language);
        $media->setHostName($importItem->hostName);
        $media->setHostUrl($importItem->hostUrl);

        // check if thumbnail has value as podcasts won't have one
        if (isset($importItem->thumbnail)) {
            $media->setThumbnail($importItem->thumbnail);
        }

        $media->setStatus(Media::STATUS_PENDING);
        $media->setIsImported(true);

        // TODO: these are supposed to default to zero, but aren't - check why!
        $media->setRating(0);
        $media->setVisits(0);

        $em->persist($media);
        $em->flush();
    }

    /**
     *
     * Check if a feed item is suitable for import into database
     *
     * @param \Doctrine\ORM\EntityManager $em
     * @param \SimplePie_Item             $item
     * @param \Datetime                   $itemUploadedToFeed
     * @param \Datetime                   $lastImportDate
     * @return bool
     */
    protected function checkSuitableForImport(EntityManager $em, \SimplePie_Item $item, $itemUploadedToFeed, $lastImportDate)
    {

        // only check new import items (ie added since last import date)
        if ($itemUploadedToFeed < $lastImportDate) {
            return false;
        }

        // check db to see if item was:
        //   - manually added by a protalk team member
        //   - somehow re-added to the feed, at a later date, but with the same title
        //   - previously imported but a protalk team member edited the title (hence permalink check)
        $repository = $em->getRepository('ProtalkMediaBundle:Media');
        $itemExists = $repository->itemExists($item->get_title(), $item->get_permalink());

        if ($itemExists) {
            return false;
        }

        return true;
    }
}
