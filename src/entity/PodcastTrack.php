<?php

namespace iutnc\deefy\entity;

class PodcastTrack extends AudioTrack {

    public function __construct(protected string $title, protected string $author) {
        parent::__construct($title, 10);
        $this->author = $author;
    }

}
