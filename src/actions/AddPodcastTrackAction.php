<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;

class AddPodcastTrackAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-track'>

            <label>
            <p>Playlist's name :</p>
            <input type='text' name='pname' placeholder='cool playlist' />
            </label>

            <label>
            <p>Track's name :</p>
            <input type='text' name='name' placeholder='cool track' />
            </label>

            <label>
            <p>Track's author :</p>
            <input type='text' name='author' placeholder='cool dude' />
            </label>

            <label>
            <p>Track's file :</p>
            <input type='file' name='track_file' />
            </label>

            <br />
            <br />

            <input type='submit' value='Send'/>
        </form>
        ";
    }

    public function executePost() : string{
        $r = "";
        if (isset($_SESSION["playlists"][$_POST['pname']])) {
            $track = new PodcastTrack($_POST['name'], $_POST['author']);
            $playlist = $_SESSION["playlists"][$_POST['pname']];
            $playlist->addTrack( $track );
            $playlistRenderer = new AudioListRenderer( $playlist );
            $r = "<p>" . $playlistRenderer->render() . "</p><a href='./?action=add-track'>Add another track</a>";
        } else {
            $r = "<p>The playlist doesn't exist !</p><a href='./?action=add-track'>Get back</a>";
        }
        return $r;
    }

}
