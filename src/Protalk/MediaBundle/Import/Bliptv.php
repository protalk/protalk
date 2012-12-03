<?php

namespace Protalk\MediaBundle\Import;

//include_once('BaseImport.php');

use Protalk\MediaBundle\Import\Base;

/**
 * Bliptv import class
 * 
 * This class handles feeds from Bliptv
 * 
 * @author Lineke Kerckhoffs-Willems
 */
class Bliptv extends Base
{
    /**
     * Handle import
     * 
     * @param \Protalk\MediaBundle\Import\SimplePie_Item                    $item
     * @param \Protalk\MediaBundle\Import\Protalk\MediaBundle\Entity\Feed   $feed
     * @param \Doctrine\ORM\EntityManager                                   $em
     */
    public function handleImport(\SimplePie_Item $item, \Protalk\MediaBundle\Entity\Feed $feed, \Doctrine\ORM\EntityManager $em)
    {
        var_dump($item->get_authors(), $item->get_contributors());
        $enclosures = $item->get_enclosures();
        
        $title = $item->get_title();
        $date = new \DateTime($item->get_date());
        $description = $item->get_content();
        $length = $enclosures[0]->get_duration(true);
        $language = 'en';
        $mediaTypeId = 2;
        $content = '';
        
        $hostName = $feed->getName();
        $hostUrl = $item->get_permalink();
        $thumbnail = $enclosures[0]->get_thumbnail(0);
        
        //$this->insertMedia($em, $title, $date, $description, $mediaTypeId, $length, $content, $language, $hostName, $hostUrl, $thumbnail);
        
        // Notes: add default language and mediatypeId to feed table
        // Save original title and imported = true in media table, original title is 
        // needed to be able to detect that the item was already imported (could be renamed after adding)
    }
}
