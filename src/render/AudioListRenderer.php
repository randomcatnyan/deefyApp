<?php

namespace iutnc\deefy\render;

use iutnc\deefy\entity\AudioList;

class AudioListRenderer implements RenderInterface {

    public function __construct(private AudioList $audioList) {
    }

    public function render(int $selector = RenderInterface::COMPACT): string {
        $tracksRender = '';
        foreach ($this->audioList->getTracks() as $track) {
            $tracksRender = $tracksRender . $track->title . "<br />";
        }
        return sprintf(
            "Playlist %s :<br />track count : %s, duration : %s <br />%s",
            $this->audioList->getName(),
            $this->audioList->getTrackCount(),
            $this->audioList->getDuration(),
            $tracksRender
        );
    }

}
