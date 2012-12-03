<?php

namespace Protalk\MediaBundle\Import;

use Protalk\MediaBundle\Entity;

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
     * @param \Protalk\MediaBundle\Import\SimplePie_Item                    $item
     * @param \Protalk\MediaBundle\Import\Protalk\MediaBundle\Entity\Feed   $feed
     * @param \Doctrine\ORM\EntityManager                                   $em
     */
    abstract public function handleImport(\SimplePie_Item $item, \Protalk\MediaBundle\Entity\Feed $feed, \Doctrine\ORM\EntityManager $em);

    /**
     * Insert media item
     * 
     * @param \Doctrine\ORM\EntityManager   $em
     * @param string                        $title
     * @param \DateTime                     $date
     * @param string                        $description
     * @param int                           $mediaTypeId
     * @param string                        $length
     * @param string                        $content
     * @param string                        $language
     * @param string                        $hostName
     * @param string                        $hostUrl
     * @param string                        $thumbnail
     */
    protected function insertMedia(\Doctrine\ORM\EntityManager $em, $title, $date, $description, $mediaTypeId, $length, $content, $language, $hostName, $hostUrl, $thumbnail)
    {
        $media = new Entity\Media();
        $media->setTitle($title);
        $media->setDate($date);
        $media->setDescription($description);
        $media->setMediatypeId($mediaTypeId);
        $media->setLength($length);
        $media->setContent($content);
        $media->setLanguage($language);
        $media->setHostName($hostName);
        $media->setHostUrl($hostUrl);
        $media->setThumbnail($thumbnail);
        $media->setIsPublished(false);
        
        $em->persist($media);
        $em->flush();
    }
}