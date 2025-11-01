<?php
namespace iutnc\deefy\actions;
require_once 'vendor/autoload.php';

use iutnc\deefy\auth\AuthProvider;

class DefaultAction extends Action {

    public function executeGet() : string{
        $to_return = "";

        if ( AuthProvider::isLoggedIn() ) {
            $to_return = "
            <p>You can :
                <ul>
                <li><a href='./?action=display-playlist' >Show playlists</a></li>
                <li><a href='./?action=add-playlist' >Add a playlist</a></li>
                <li><a href='./?action=add-track' >Add a track</a></li>
                </ul>
            ";
        } else {
            $to_return = "
            <p>
            Welcome !<br />
            This is small web app to upload and manage audio tracks<br />
            Start by signing into an account<br />
            <br />
            <span style='font-size:small'>
            Note to random internauts :<br />
            THIS IS NOT A REAL SECURE WEB APP <br />
            It's mostly been done to learn php and deploying and all<br />
            Please don't send sensitive infos or your real email
            <br />
            </span>
            <br />
            ";
        }
        $to_return = $to_return . "<a href='https://github.com/randomcatnyan/deefyApp' style='font-size:small' >Source code</a>
        </p>";
        return $to_return;
    }

    public function executePost() : string{
        return $this->executeGet();
    }

}
