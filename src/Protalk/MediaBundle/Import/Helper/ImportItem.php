<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Import\Helper;

/**
 * Class to hold values extracted from imported feed item
 * for persistence in the database
 *
 * @author Kim Rowan
 */
class ImportItem
{
    /**
     * @var string title
     */
    public $title;

    /**
     * @var \Datetime date item recorded
     */
    public $date;

    /**
     * @var string description
     */
    public $description;

    /**
     * @var string duration
     */
    public $length;

    /**
     * @var string language
     */
    public $language = 'en';

    /**
     * @var object mediatype
     */
    public $mediatype;

    /**
     * @var string url or iframe depending on mediatype
     */
    public $content;

    /**
     * @var string feed name
     */
    public $hostName;

    /**
     * @var string host url (permalink)
     */
    public $hostUrl;

    /**
     * @var string thumbnail src
     */
    public $thumbnail;


}

