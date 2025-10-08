<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class AddPlaylistAction extends Action {

    public function execute() : string{

        // var_dump($_GET,"|||", $_POST);

        $playlist_name = $_POST['name'] ?? null;
        $r = "";

        if (isset($_POST['name'])) {
            $r = ;
        } else {
            $r = "
            <form method='post' action='?action=add-playlist'>
                <label for='name' >Playlist's name : </label>
                <input type='text' id='name' name='name' laceholder='ma playlist' />
                <input type='submit' value='Send'/>
            </form>
            ";
        }
        return $r;
    }

}
