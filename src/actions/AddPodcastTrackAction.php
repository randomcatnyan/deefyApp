<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\entity\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;

class AddPodcastTrackAction extends Action {

    public function execute() : string{

        $r="";

        if (isset($_POST['name'])) {
            $t = new PodcastTrack($_POST['name'], $_POST['author']);
            // $pr = new AudioListRenderer($p);
            $r = "<p>" . $tr->render() . "</p><a href='?action=add-track'>Ajouter encore une piste</a>";
        } else {
            $r = "
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

                <input type='submit' value='Send'/>
            </form>
            ";
        }

        return $r;
    }

}
