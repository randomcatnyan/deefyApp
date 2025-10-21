<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class DisplayPlaylistAction extends Action {

    public function execute() : string{

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
            $p = $db->findPlaylistById($_GET["id"]);
            if ($p != null) {
                $r = $r . $this->render_line($p);
            }
            $r = $r . "<a href='./?display-playlist'><p>All playlists</p></a>";
        } else {
            $r = $r . "<p>Saved playlists :</p><p>";
            $all_playlists = $db->getAllPlaylists();
            foreach ( $all_playlists as $l){
                $r = $r . $this->render_line($l);
            }
            $r = $r . "</p>";
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
