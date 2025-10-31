<?php
namespace iutnc\deefy\auth;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class Authz {

    public static function checkRole(int $role):bool {

        if ( !isset( $_SESSION["user"] ) ) {
            return false;
        }

        $db = DeefyRepository::getInstance();
        $user = $db->findUserByEmail($_SESSION["user"]);

        if ( $user == null ) {
            return false;
        }

        return ( $user["role"] == $role );

    }

    //unfinished
    public static function checkPlaylistOwner(int $playlist_id):bool {

        $db = DeefyRepository::getInstance();

        return $this->checkRole(100);

    }

}
