<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class DefaultAction extends Action {

    public function executeGet() : string{
        return "
        <p>Welcome !
            <ul>
                <li><a href='http://localhost:8080?action=display-playlist' >show playlists</a></li>
                <li><a href='http://localhost:8080?action=add-playlist' >add playlist</a></li>
                <li><a href='http://localhost:8080?action=add-track' >add track</a></li>
            </ul>
        </p>
        ";
    }

    public function executePost() : string{}

}
