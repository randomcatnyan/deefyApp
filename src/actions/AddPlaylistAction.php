<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\Playlist;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPlaylistAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-playlist'>
            <label>
            <p>Playlist's name : </p>
            <input type='text' name='name' placeholder='cool playlist' />
            </label>
            <input type='submit' value='Send'/>
        </form>
        ";
    }

    public function executePost() : string{

        $db = DeefyRepository::getInstance();

        $playlist_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);

        $playlist = new Playlist($playlist_name);
        $db->saveEmptyPlaylist($playlist);
        $playlistRenderer = new AudioListRenderer($playlist);
        $r = "<p>" . $playlistRenderer->render() . "</p><a href='?action=add-track'><p>Add tracks</p></a>";
        return $r;
    }

}
