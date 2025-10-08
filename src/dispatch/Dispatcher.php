<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\Action;

class Dispatcher {

    protected ?string $action = null;

    public function __construct(){

        $this->action = $_GET['action'] ?: null;

    }

    public function run(): void{
        $q = null;
        switch($this->action) {
            case "playlist":
                $q = new DisplayPlaylistAction();
            case "add-playlist":
                $q = new AddPlaylistAction();
            case "add-track":
                $q = new AddPodcastTrackAction();
            default:
                $q = new DefaultAction();
        }
        $this->renderPage($q.execute());
    }

    public function renderPage(string $html): void{

        echo"
        <!DOCTYPE html>
        <html lang='en'>
        <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>deefy l'app</title>
        </head>
        <body>
        " . $html . "
        </body>
        </html>
        ";


    }

}
