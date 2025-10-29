<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPodcastTrackAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-track' enctype ='multipart/form-data'>

            <label>
            <p>ID of the playlist to add the track to :</p>
            <input type='text' name='pl_id' placeholder='1' />
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
        $db = DeefyRepository::getInstance();

        $playlist_id = filter_var($_POST['pl_id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $track_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $author_name = filter_var($_POST['author'], FILTER_SANITIZE_SPECIAL_CHARS);

        $playlist = $db->findPlaylistById($playlist_id);
        if ($playlist != null) {

            //gere le fichier du track
            if ( ($_FILES['track_file']['type'] === 'audio/mpeg') && substr($_FILES['track_file']['name'],-4) === '.mp3' ) {
                $dest = dirname(__FILE__, 2) . '/audio/' . uniqid() . '.mp3';
                if (move_uploaded_file( $_FILES['track_file']['tmp_name'], $dest )) {
                    $r = $r . "<p>Succesfully uploaded file !</p>";
                } else {
                    $r = $r . "<p>Warning : file not correctly uploaded</p>";
                }
            } else {
                $r = $r . "<p>Warning : file upload failed, wrong file type</p>";
            }

            $track = new PodcastTrack($track_name, $author_name);

            $db->saveTrack($track);
            $db->addTrackToPlaylist($track, $playlist);

            $playlist->addTrack( $track );
            $playlistRenderer = new AudioListRenderer( $playlist );
            $r = $r . "<p>" . $playlistRenderer->render() . "</p><a href='./?action=add-track'>Add another track</a>";
        } else {
            $r = "<p>The playlist doesn't exist !</p><a href='./?action=add-track'>Get back</a>";
        }
        return $r;
    }

}
