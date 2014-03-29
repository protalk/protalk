<?php

namespace Protalk\PageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Protalk\PageBundle\Entity\Page;

class PageData extends AbstractFixture implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setUrl('contact');
        $page->setPageTitle('Contact Us');
        $page->setTitle('Contact');
        $page->setContent(
            "We'd really appreciate any feedback you have about the site. Bug reports are also very welcome. Go on, let
            us know what you think: </p><p>Email: <a href=\"mailto:info@protalk.me\">info@protalk.me</a><br>Twitter:
            <a href=\"http://twitter.com/pro_talk\">@pro_talk</a></p><p>You can also subscribe to our mailing list to
            keep in touch via our newsletter:<form
            action=\"http://protalk.us4.list-manage.com/subscribe/post?u=4192f6a464ac9b433d406efff&amp;id=e97aea0468\"
            method=\"post\" id=\"mc-embedded-subscribe-form\" name=\"mc-embedded-subscribe-form\" class=\"validate\">
            \r\n<input id=\"subscribeEmail\" class=\"subscribe\" name=\"EMAIL\" type=\"email\"
            placeholder=\"Enter your email address here\"/>\r\n<input id=\"subscribeButton\" class=\"subscribe\"
            type=\"image\" src=\"/images/subscribe_btn.png\" />\r\n</form>"
        );
        $manager->persist($page);

        $this->addReference('page#contact', $page);

        $page = new Page();
        $page->setUrl('contribute');
        $page->setPageTitle('How to Contribute');
        $page->setTitle('Contribute');
        $page->setContent(
            "Contributing to ProTalk couldn\'t be easier. All you need to do is find a video or audio recording about
            PHP that you enjoyed and think others could learn from, complete the form below and we\'ll take it from
            there.</p><p>Once we\'ve verified that we\'re allowed to embed the material, we\'ll publish it on the site
            and send you an email letting you know its available. Well….what are you waiting for?</p><p>If you want to
            help us develop ProTalk and make it even better,
            <a class=\"pageLink\" href=\"https://github.com/protalk/protalk\">fork us on GitHub</a> and check out the
            <a class=\"pageLink\" href=\"https://github.com/protalk/protalk/issues\">list of open issues</a>."
        );
        $manager->persist($page);

        $this->addReference('page#contribute', $page);

        $page = new Page();
        $page->setUrl('about');
        $page->setPageTitle('About Us');
        $page->setTitle('About');
        $page->setContent(
            "ProTalk is the brain child of Kim Rowan and Lineke Kerckhoffs-Willems. A spark of an idea on IRC in July
            2011 transformed into the site you see before you and we really hope you like it.</p><p>ProTalk\'s mission
            is to provide a central point of access to online audio / video content with a PHP focus. We hope to expand
            and include other programming languages in the future, but for now we\'re focussing solely on PHP and
            surrounding tools and skills.</p><p>ProTalk aims to be a community resource and, as such, we will
            depend on you to <a href=\"http://protalk.me/contribute/new\">contribute content</a>. Just send us links to
            recorded talks, postcasts, screencasts, etc., that are already online or hosted elsewhere and we\'ll do the
            rest."
        );
        $manager->persist($page);

        $this->addReference('page#about', $page);

        $manager->flush();
    }
}
