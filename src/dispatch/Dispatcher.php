<?php
namespace iutnc\deefy\dispatch;
require_once 'vendor/autoload.php';

use iutnc\deefy\actions\AddPlaylistAction;
use iutnc\deefy\actions\AddPodcastTrackAction;
use iutnc\deefy\actions\DefaultAction;
use iutnc\deefy\actions\DisplayPlaylistAction;
use iutnc\deefy\actions\AddUserAction;
use iutnc\deefy\actions\SigninAction;


class Dispatcher {

    protected ?string $action = null;

    public function __construct() {

        $this->action = $_GET['action'] ?? null;

    }

    public function run(): void{
        switch($this->action) {
            case "display-playlist":
                $actionRender = new DisplayPlaylistAction();
                break;
            case "add-playlist":
                $actionRender = new AddPlaylistAction();
                break;
            case "add-track":
                $actionRender = new AddPodcastTrackAction();
                break;
            case "add-user":
                $actionRender = new AddUserAction();
                break;
            case "signin":
                $actionRender = new SigninAction();
                break;
            default:
                $actionRender = new DefaultAction();
        }
        $this->renderPage($actionRender());
    }

    public function renderPage(string $html): void {

        echo"
        <!DOCTYPE html>
        <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>deefy app</title>
                <link rel='icon' href='favicon.png' />
            </head>
            <body>
                <div>
                    <p>
                        <a href='../../index.php'>Home</a>
                        |
                        <a href='../../index.php?action=add-user'>Register</a>
                        <a href='../../index.php?action=signin'>Login</a>
                    </p>
                </div>
                " . $html . "
            </body>
        </html>
        ";


    }

}
