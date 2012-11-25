<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{

    /**
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('ProtalkMediaBundle:Category');
        $categories = $repository->getMostUsedCategories();

        $categories = $this->truncateName($categories);

        return array('categories' => $categories);
    }

    /**
     * Truncate name element in array of categories
     *
     * @param array $categories Array of categories
     * @param integer $length Maximum allowed length of category name
     * @return array
     */
    public function truncateName($categories, $length = 17)
    {
        $counter = 0;
        foreach ($categories as $category) {
            foreach ($category as $key => $value) {
                if ($key == 'name') {
                    $categories[$counter]['truncated'] = strlen($value) <= $length ? $value : substr($value, 0, $length) . '...';
                }
            }
            $counter++;
        }
        return $categories;
    }
}
