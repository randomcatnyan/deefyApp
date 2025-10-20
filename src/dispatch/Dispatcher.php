<?php
namespace iutnc\deefy\dispatch;
require_once 'vendor/autoload.php';

use iutnc\deefy\actions\AddPlaylistAction;
use iutnc\deefy\actions\AddPodcastTrackAction;
use iutnc\deefy\actions\DefaultAction;
use iutnc\deefy\actions\DisplayPlaylistAction;


class Dispatcher {

    protected ?string $action = null;

    public function __construct(){

        $this->action = $_GET['action'] ?? null;

    }

    public function run(): void{
        $q = null;
        switch($this->action) {
            case "playlist":
                $q = new DisplayPlaylistAction();
                break;
            case "add-playlist":
                $q = new AddPlaylistAction();
                break;
            case "add-track":
                $q = new AddPodcastTrackAction();
                break;
            case "display-playlist":
                break;
            default:
                $q = new DefaultAction();
        }
        $this->renderPage($q->execute());
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
                <div>
                    <p>
                        <a href='../../index.php'>Accueil</a>
                        <a href='../../index.php?action=add-user'>Inscription</a>
                        <a href='../../index.php?action=add-playlist'>Nouvelle playlist</a>
                    </p>
                </div>
                " . $html . "
            </body>
        </html>
        ";


    }

}
