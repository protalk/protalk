<?php

namespace Protalk\MediaBundle\MediaType;

use Goutte\Client;

class SlideShareProvider implements ProviderWithImageInterface
{

    /**
     * @param $url string URL for resource
     * @return bool
     */
    public function supports($url)
    {
        $info = parse_url($url);

        if ('www.slideshare.net' !== $info['host']) {
            return false;
        }

        if (false == preg_match('|^/[^/]+/[^/]+$|', $info['path'])) {
            return false;
        }

        $code = $this->getEmbedCode($url);

        if (!$code) {
            return false;
        }

        return true;
    }

    /**
     * @param $url string URL for resource
     * @param \Twig_Environment $twig
     * @return string
     */
    public function render($url, \Twig_Environment $twig)
    {
        $data = array(
            'embed_code' => $this->getEmbedCode($url)
        );

        return $twig->render('ProtalkMediaBundle:MediaType:slideshare.html.twig', $data);
    }

    /**
     * @param $url string URL for resource
     * @return mixed
     */
    public function thumb($url)
    {
        return $this->getEmbedImage($url);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'slideshare';
    }

    private function getEmbedCode($url)
    {
        $client = new Client();

        $crawler = $client->request('GET', $url);

        $data = $crawler->filter('.twitter_player');

        if ($data->count() == 0) {
            return null;
        }

        return $data->attr('value');
    }

    private function getEmbedImage($url)
    {
        $client = new Client();

        $crawler = $client->request('GET', $url);

        $data = $crawler->filter('.twitter_image');

        if ($data->count() == 0) {
            return null;
        }

        return $data->attr('value');
    }
}
