<?php
/**
 * Created by Web-West | PhpStorm.
 * User: Fomin Vasyl aka fomvasss
 * Date: 10.02.17
 * Time: 11:01
 */

namespace Fomvasss\Youtube;


class Youtube
{
    /**
     * @var mixed
     */
    private $config;

    /**
     * Youtube constructor.
     */
    public function __construct()
    {
        $this->config = config('youtube');
    }

    /**
     * @param string $link
     * @param array $options
     * @return bool|string
     */
    public function iFrame(string $link, array $options = [])
    {
        $options = $options + $this->config;

        $rel = $options['rel'];
        $autoplay = $options['autoplay'];
        $controls = $options['controls'];
        $showinfo = $options['showinfo'];
        $width = $options['width'];
        $height = $options['height'];
        $frameborder = $options['frameborder'];

        $videoID = $this->getYoutubeVideoID($link);

        if ($videoID != false) {
            return '<iframe width="'.$width.
                '" height="'.$height.
                '" src="https://www.youtube.com/embed/'.$videoID.
                '?rel='.$rel.'&amp;autoplay='.$autoplay.
                '&amp;controls='.$controls.
                '&amp;showinfo='.$showinfo.
                '" frameborder="'.$frameborder.
                '"></iframe>';
        }
        return false;
    }

    /**
     * @param $url
     * @return string|bool
     */
    private function getYoutubeVideoID($url)
    {
        if (preg_match('@\\?v\\=([\\w\\-]*)@i', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('@embed/([\\w\\-]*)@i', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('@([\\w\\-]*)@i', $url, $matches)) {
            return $matches[1];
        }
        return false;
    }

}