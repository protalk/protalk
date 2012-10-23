<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Helpers;

class ExploreSortOptions {

    private static $availableSortOptions = array(
        array('sort' => 'title', 'order' => 'asc', 'cleartext' => 'title (a - z)'),
        array('sort' => 'title', 'order' => 'desc', 'cleartext' => 'title (z - a)'),
        array('sort' => 'date', 'order' => 'asc', 'cleartext' => 'date (asc)'),
        array('sort' => 'date', 'order' => 'desc', 'cleartext' => 'date (desc)'),
        array('sort' => 'views', 'order' => 'asc', 'cleartext' => 'views (asc)'),
        array('sort' => 'views', 'order' => 'desc', 'cleartext' => 'views (desc)'),
        array('sort' => 'rating', 'order' => 'asc', 'cleartext' => 'rating (asc)'),
        array('sort' => 'rating', 'order' => 'desc', 'cleartext' => 'rating (desc)'),
    );

    public static function getAvailableSortOptions() {
        return static::$availableSortOptions;
    }

    public static function verifySortOption($sort, $order) {
        foreach (static::$availableSortOptions as $sortOption) {
            if ($sortOption['sort'] == $sort && $sortOption['order'] == $order) {
                return true;
            }
        }
        return false;
    }

    public static function verifySort($sort) {
        foreach (static::$availableSortOptions as $sortOption) {
            if ($sortOption['sort'] == $sort) {
                return true;
            }
        }
        return false;
    }
}
