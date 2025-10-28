<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\repository\DeefyRepository;

class AddPodcastTrackAction extends Action {

    public function executeGet() : string{
        return "
        <form method='post' action='?action=add-track'>

            <label>
            <p>Name of the playlist to add the track to :</p>
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
        $db = DeefyRepository::getInstance();

        $playlist_name = filter_var($_POST['pname'], FILTER_SANITIZE_SPECIAL_CHARS);
        $track_name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $author_name = filter_var($_POST['author'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($_SESSION["playlists"][$playlist_name])) {
            $track = new PodcastTrack($track_name, $author_name);
            $playlist = $_SESSION["playlists"][$playlist_name];
            $playlist->addTrack( $track );
            $playlistRenderer = new AudioListRenderer( $playlist );
            $r = "<p>" . $playlistRenderer->render() . "</p><a href='./?action=add-track'>Add another track</a>";
        } else {
            $r = "<p>The playlist doesn't exist !</p><a href='./?action=add-track'>Get back</a>";
        }
        return $r;
    }

}

/* code du cours 12 pour les fichiers
$upload_dir = __DIR__ . '/img/';
$filename = uniqid();
$tmp = $_FILES['inputfile']['tmp_name'] ;
if ( ( $_FILES['inputfile']['error'] === UPLOAD_ERR_OK) && ($_FILES['inputfile']['type'] === 'image/png') ) {
    $dest = $upload_dir.$filename.'.png';
    if (move_uploaded_file($tmp, $dest )) {
        print "téléchargement terminé avec succès<br>";
    } else {
        print "hum, hum téléchargement non valide<br>";
    }
} else {
    print "echec du téléchargement ou type non autorisé<br>";
}
*/
