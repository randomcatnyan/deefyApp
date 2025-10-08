<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\Playlist;
use iutnc\deefy\render\AudioListRenderer;

class AddPlaylistAction extends Action {

    public function execute() : string{

        $r = "";

        if (isset($_POST['name'])) {
            $p = new Playlist($_POST['name']);
            $pr = new AudioListRenderer($p);
            $r = "<p>" . $pr->render() . "</p><a href='?action=add-track'>Ajouter une piste</a>";
        } else {
            $r = "
            <form method='post' action='?action=add-playlist'>
                <label for='name' >Playlist's name : </label>
                <input type='text' id='name' name='name' placeholder='ma playlist' />
                <input type='submit' value='Send'/>
            </form>
            ";
        }
        return $r;
    }

}
