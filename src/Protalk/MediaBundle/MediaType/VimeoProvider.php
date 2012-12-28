<?php

namespace Protalk\MediaBundle\MediaType;

class VimeoProvider implements ProviderInterface
{

    /**
     * @param $url string URL for resource
     * @return bool
     */
    public function supports($url)
    {
        $info = parse_url($url);

        if ('vimeo.com' !== $info['host'] && 'player.vimeo.com' !== $info['host']) {
            return false;
        }

        if (false == preg_match('|^(?:/video)?/[0-9]{1,}+$|', $info['path'])) {
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
            'video_id' => $this->getVideoId($url),
        );
        return $twig->render('ProtalkMediaBundle:MediaType:vimeo.twig.html', $data);
    }

    /**
     * Implemented via
     * http://darcyclarke.me/development/get-image-for-youtube-or-vimeo-videos-from-url/
     *
     * @param $url string URL for resource
     * @return mixed
     */
    public function thumb($url)
    {
        $video_id = $this->getVideoId($url);
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$video_id.".php"));
        return $hash[0]["thumbnail_small"];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vimeo';
    }

    private function getVideoId($url)
    {
        $info = parse_url($url);

        if (isset($info['path'])) {
            return substr($info['path'], 1);
        }

        return null;
    }
}
