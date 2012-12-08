<?php

namespace Protalk\MediaBundle\MediaType;

class YouTubeProvider implements ProviderInterface
{
    public function supports($url)
    {
        $url_info = parse_url($url);

        if (false === isset($url_info['host'])) {
            return false;
        }

        if (false === strpos($url_info['host'], '.youtube.com')) {
            return false;
        }

        if (false === $this->getVideoId($url)) {
            return false;
        }

        return true;
    }

    public function render($url, \Twig_Environment $twig)
    {
        $data = array(
            'video_id' => $this->getVideoId($url),
        );
        return $twig->render('ProtalkMediaBundle:MediaType:YouTube.twig.html', $data);
    }

    /**
     * @param $url string YouTube URL
     * @return string|bool YouTube ID, or false if not found
     */
    private function getVideoId($url)
    {
        $url_info = parse_url($url);

        if (false === isset($url_info['query'])) {
            return false;
        }

        $params = explode('&', $url_info['query']);
        foreach ($params as $param) {
            list($key, $value) = explode('=', $param, 2);
            if ('v' === $key) {
                return $value;
            }
        }
        return false;
    }

    public function getName()
    {
        return 'youtube';
    }
}
