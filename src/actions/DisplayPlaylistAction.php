<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class DisplayPlaylistAction extends Action {

    public function execute() : string{

        $r = "Playlists enregistrees :<br /><br />";

        if (isset($_GET["id"])) {

        } else {

        }

        return $r;
    }

}
