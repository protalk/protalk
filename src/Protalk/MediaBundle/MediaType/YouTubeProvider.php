<?php

namespace Protalk\MediaBundle\MediaType;

class YouTubeProvider implements ProviderInterface
{
    public function supports($url)
    {
        $url_info = parse_url($url);

        if (!isset($url_info['host']))
            return false;

        if (strpos($url_info['host'], '.youtube.com') === false)
            return false;

        if ($this->getVideoId($url) === false)
            return false;

        return true;
    }

    public function render($url)
    {
        // TODO: Implement render() method.
    }

    /**
     * @param $url YouTube URL
     * @return string|bool YouTube ID, or false if not found
     */
    private function getVideoId($url)
    {
        $url_info = parse_url($url);

        if (!isset($url_info['query']))
            return false;

        $params = explode('&', $url_info['query']);
        foreach($params as $param)
        {
            list($key, $value) = explode('=', $param, 2);
            if ($key == 'v')
                return $value;
        }
        return false;
    }

    public function getName()
    {
        return 'youtube';
    }
}
