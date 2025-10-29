<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\render\AudioListRenderer;

class DisplayPlaylistAction extends Action {

    public function executeGet() : string{

        $r = "
        <search>
        <form method='get' action='./index.php'>

                <input type='hidden' name='action' value='display-playlist' />

                <label>
                    <p>Search playlist by id :</p>
                    <input type='search' name='id' />
                </label>

                <input type='submit' value='Send'/>

        </form>
        </search>
        <br />
        ";

        $db = DeefyRepository::getInstance();

        if (isset($_GET["id"])) {
            $playlist = $db->findPlaylistById($_GET["id"]);
            if ($playlist != null) {
                $playlistRenderer = new AudioListRenderer($playlist);
                $r = $r . $playlistRenderer->render();
            }
            $r = $r . "<a href='./?action=display-playlist'><p>All playlists</p></a>";
        } else {
            $r = $r . "<p>Saved playlists :</p>";
            $all_playlists = $db->getAllPlaylists();
            foreach ( $all_playlists as $p){
                $renderer = new AudioListRenderer($p);
                $r = $r . "ID : " . $p->getID() . "<br />" . $renderer->render() . "<br />";
            }
        }

        return $r;
    }

    private function render_line($line){
        $r="<p>";
        foreach ($line as $e){
            $r = $r . $e . " ";
        }
        $r = $r . "<br />";
        return $r . "</p>";
    }

    public function executePost() : string{
        return "";
        //cette action n'est pas supposee modifier des donnees donc rien ici ...
    }

}
