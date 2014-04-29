<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Entity\Media;
use Protalk\MediaBundle\Entity\Feed;

use SimplePie_Item;
use Doctrine\ORM\EntityManager;

/**
 * Base Import class
 *
 * This class handles the imports, this is the base class because every feedtype
 * should have it's own implementation based on this class
 *
 * @author Lineke Kerckhoffs-Willems and Kim Rowan
 */
abstract class Base
{
    protected $entityManager;

    public function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Handle import
     *
     * @param \SimplePie_Item                    $item
     * @param \Protalk\MediaBundle\Entity\Feed   $feed
     */
    abstract public function handleImport(\SimplePie_Item $item, Feed $feed);

    /**
     * Insert media item
     *
     * @param $importItem
     * @param \Protalk\MediaBundle\Entity\Media $media
     */
    protected function insertMedia($importItem, Media $media)
    {
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

        $this->entityManager->persist($media);
        $this->entityManager->flush();
    }

    /**
     *
     * Check if a feed item is suitable for import into database
     *
     * @param \SimplePie_Item  $item
     * @param \Datetime        $itemUploadedToFeed
     * @param \Datetime        $lastImportDate
     * @return bool
     */
    protected function checkSuitableForImport(\SimplePie_Item $item, $itemUploadedToFeed, $lastImportDate)
    {
        // only check new import items (ie added since last import date)
        if ($itemUploadedToFeed < $lastImportDate) {
            return false;
        }

        // check db to see if item was:
        //   - manually added by a protalk team member
        //   - somehow re-added to the feed, at a later date, but with the same title
        //   - previously imported but a protalk team member edited the title (hence permalink check)
        $repository = $this->entityManager->getRepository('ProtalkMediaBundle:Media');
        $itemExists = $repository->itemExists($item->get_permalink());

        if ($itemExists) {
            return false;
        }

        return true;
    }
}
