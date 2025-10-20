<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class DisplayPlaylistAction extends Action {

    public function execute() : string{

        $r = "Playlists enregistrees :<br /><br />";
        $db = DeefyRepository::getInstance();

        if (isset($_GET["id"])) {
            $r = $r . $this->render_line($db->findPlaylistById($_GET["id"]));
        } else {
            $all_playlists = $db->getAllPlaylists();
            foreach ( $all_playlists as $l){
                $r = $r . $this->render_line($l);
            }
        }

        return $r;
    }

    private function render_line($l){
        $r="";
        foreach ($l as $e){
            $r = $r . $e . " ";
        }
        $r = $r . "<br />";
        return $r;
    }

}
