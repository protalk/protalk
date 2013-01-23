<?php

namespace Protalk\MediaBundle\MediaType;

use Goutte\Client;

class SpeakerDeckProvider implements ProviderInterface
{

    /**
     * @param $url string URL for resource
     * @return bool
     */
    public function supports($url)
    {
        $info = parse_url($url);

        if ('speakerdeck.com' !== $info['host']) {
            return false;
        }

        if (false == preg_match('|^/[^/]+/[^/]+$|', $info['path'])) {
            return false;
        }

        $data = $this->getEmbedData($url);

        if (!$data) {
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
        $data = $this->getEmbedData($url);
        return $twig->render('ProtalkMediaBundle:MediaType:speakerdeck.html.twig', $data);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'speakerdeck';
    }

    private function getEmbedData($url)
    {
        $client = new Client();

        $crawler = $client->request('GET', $url);

        $data = $crawler->filter('.speakerdeck-embed');

        if ($data->count() == 0) {
            return null;
        }

        return array(
            'id' => $data->attr('data-id'),
            'ratio' => $data->attr('data-ratio')
        );
    }
}
