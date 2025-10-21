<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\render\AudioListRenderer;

class DisplayPlaylistAction extends Action {

    public function executeGet() : string{

        $r = "
        <search>
            <form method='get' action='?action=display-playlist'>

                <label>
                    <p>Search playlist :</p>
                    <input type='search' name='id' />
                </label>

                <input type='submit' formaction='?action=display-playlist' value='Send'/>

            </form>
        </search>
        ";

        $db = DeefyRepository::getInstance();

        if (isset($_GET["id"])) {
            $playlist = $db->findPlaylistById($_GET["id"]);
            if ($playlist != null) {
                $r = $r . $this->render_line($playlist);
            }
            $r = $r . "<a href='./?display-playlist'><p>All playlists</p></a>";
        } else {
            $r = $r . "<p>Saved playlists :</p>";
            $all_playlists = $db->getAllPlaylists();
            foreach ( $all_playlists as $row){
                $r = $r . $this->render_line($row);
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
