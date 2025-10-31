<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\auth\Authz;

class DisplayPlaylistAction extends Action {

    public function executeGet() : string{

        $r = "
        <search>
        <form method='get' action='./'>

                <input type='hidden' name='action' value='display-playlist' />

                <label>
                    <p>Search playlist by id :</p>
                    <input type='number' name='id' />
                </label>

                <input type='submit' value='Send'/>

        </form>
        </search>
        <br />
        ";

        $db = DeefyRepository::getInstance();

        if (isset($_GET["id"])) {
            $playlist = $db->findPlaylistById($_GET["id"]);
            if ($playlist != null and Authz::checkPlaylistOwner($_GET["id"])) {
                $playlistRenderer = new AudioListRenderer($playlist);
                $r = $r . $playlistRenderer->render();
            } else {
                $r = $r . "<p>This playlist doesn't exist !</p>";
            }
            $r = $r . "<a href='./?action=display-playlist'><p>All playlists</p></a>";
        } else {
            $r = $r . "<p>Saved playlists :<br /><br />[ID] Name<br />";
            $all_playlists = $db->getAllPlaylists();
            foreach ( $all_playlists as $p){
                $playlist_id = $p->getID();
                if ( Authz::checkPlaylistOwner($playlist_id) ) {
                    $r = $r . "[<a href='./?action=display-playlist&id=$playlist_id'>$playlist_id</a>] " . $p->getName() . "<br />";
                }
            }
            $r = $r . "</p>";
        }

        return $r;
    }

    public function executePost() : string{
        return executeGet();
        //cette action n'est pas supposee modifier des donnees donc meme chose qu'en GET ...
    }

}
