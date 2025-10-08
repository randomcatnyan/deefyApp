<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class AddPlaylistAction extends Action {

    public function execute() : string{
        return "
        <form method='post' action='?action='add-playlist''>
            <label for='name' >Playlist's name : </label>
            <input type='text' id='name' name='name' laceholder='ma playlist' />
            <input type='submit' value='Send'/>
        </form>
        ";
    }

}
