<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

class DefaultAction extends Action {

    public function execute() : string{
        return "
        <p>Bienvenue !
            <ul>
                <li><a href='http://localhost:8080?action=display-playlist' >show playlist</a></li>
                <li><a href='http://localhost:8080?action=add-playlist' >add playlist</a></li>
                <li><a href='http://localhost:8080?action=add-track' >add track</a></li>
            </ul>
        </p>
        ";
    }

}
