<?php
namespace iutnc\deefy\auth;
require_once 'vendor/autoload.php';

use iutnc\deefy\repository\DeefyRepository;

class Authz {

    public static function checkRole(int $role):bool {

        if ( isset( $_SESSION["user"] ) ) {
            $db = DeefyRepository::getInstance();
            $user = $db->findUserByEmail($_SESSION["user"]);
            if ( $user != null ) {
                return ( $user["role"] == $role );
            }
        }
        return false;

    }

    public static function checkPlaylistOwner(int $playlist_id):bool {

        $db = DeefyRepository::getInstance();

        $user = $db->findUserByEmail($_SESSION["user"]);
        if ( $user == null ) {
            return false;
        }

        return Authz::checkRole(100) or $db->userOwnPlaylist($user["id"] , $playlist_id);

    }

}
