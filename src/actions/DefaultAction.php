<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class DefaultAction extends Action {

    public function executeGet() : string{
        return "
        <p>Welcome !
            <ul>
                <li><a href='http://localhost:8080?action=display-playlist' >Show playlists</a></li>
                <li><a href='http://localhost:8080?action=add-playlist' >New playlist</a></li>
                <li><a href='http://localhost:8080?action=add-track' >New track</a></li>
            </ul>
        </p>
        ";
    }

    public function executePost() : string{
        return "";
    }

}
