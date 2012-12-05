<?php

namespace Protalk\MediaBundle\MediaType;

class YouTubeProvider implements ProviderInterface
{
    public function supports($url)
    {
        $url_info = parse_url($url);

        $has_host = isset($url_info['host']);
        if (false === $has_host)
            return false;

        $is_youtube = strpos($url_info['host'], '.youtube.com');
        if (false === $is_youtube)
            return false;

        $has_video_id = $this->getVideoId($url);
        if (false === $has_video_id)
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

        $has_query = isset($url_info['query']);
        if (false === $has_query)
            return false;

        $params = explode('&', $url_info['query']);
        foreach($params as $param) {
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
