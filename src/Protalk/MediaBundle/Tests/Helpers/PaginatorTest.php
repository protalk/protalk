<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Tests\Helpers;

use Protalk\MediaBundle\Helpers\Paginator;

class PaginatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNumPages()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getNumPages(), 5);

        $paginator = new Paginator(101, 1, 20, 2);
        $this->assertEquals($paginator->getNumPages(), 6);
    }

    public function testGetCurrentPage()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getCurrentPage(), 1);

        $paginator = new Paginator(100, 24, 20, 2);
        $this->assertEquals($paginator->getCurrentPage(), 24);
    }

    public function testGetUrl()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getUrl('http://protalk.me/page', 2), 'http://protalk.me/page?page=2');
    }

    public function testGetLimit()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getLimit(), 20);
    }

    public function testGetOffset()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getOffset(), 0);

        $paginator = new Paginator(100, 3, 20, 2);
        $this->assertEquals($paginator->getOffset(), 40);
    }

    public function testGetRange()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getRange(), array(1.0, 2.0, 3.0));
    }

    public function testGetMidRange()
    {
        $paginator = new Paginator(100, 1, 20, 2);
        $this->assertEquals($paginator->getMidRange(), 2);
    }
}
