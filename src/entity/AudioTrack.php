<?php

namespace iutnc\deefy\entity;

use iutnc\deefy\InvalidPropertyNameException;

class AudioTrack
{
    protected int $id;
    public function __construct(protected string $title, protected int $duration = 0)
    {
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new InvalidPropertyNameException("Unknown property $name");
    }

    public function setID(int $id) {
        $this->id = $id;
    }

}
