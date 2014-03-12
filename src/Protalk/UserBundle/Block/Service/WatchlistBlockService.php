<?php

/**
 * ProTalk
 *
 * Copyright (c) 2012-2013, ProTalk
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Protalk\UserBundle\Block\Service;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Protalk\UserBundle\Block\Service\WatchlistBlockService
 *
 * @author Kim Rowan
 *
 */
class WatchlistBlockService extends BaseBlockService
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    private $securityContext;

    /**
     * Constructor
     *
     * @param string $name
     * @param EngineInterface $templating
     * @param SecurityContext $security
     */
    public function __construct($name, EngineInterface $templating, SecurityContext $security)
    {
        parent::__construct($name, $templating);

        $this->securityContext = $security;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user = $this->securityContext->getToken()->getUser();

        $watchlist = $user->getWatchlist();

        return $this->renderResponse($blockContext->getTemplate(), array(
            'user' => $user,
            'watchlist' => $watchlist,
            'block'     => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings()
        ), $response);
    }

   /**
    * {@inheritdoc}
    */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'watchlist';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'template' => 'ProtalkUserBundle:Block:block_watchlist.html.twig'
        ));
    }
}